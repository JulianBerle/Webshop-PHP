<?php 
    if(!isset($_COOKIE['Login-admin'])) {
        // echo "<style>section { display: none; }</style>";
        // echo "<div class='acces_denied'><h1>ACCES DENIED</h1></div>";
        header("Location: ../");
    } else {

    }

    include_once("../include.php");


    if(isset($_POST['itemSubmit']) && isset($_FILES['my_image'])) {
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ( $error === 0) {
            if ($img_size > 9999999999999999999999) {
                phpAlert("Sorry, your file is too large");
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = ['jpg', 'jpeg', 'png'];
                if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true). '.' . $img_ex_lc;
                        $img_upload_path = '../assets/images/product-images/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                    phpAlert("You can't upload files of this type");
                }
            } 
        } else {
            phpAlert("Unknow error occured. Try again later");
        }
        $name = $_POST['titel'];
        $price = $_POST['prijs'];

        $messageData = [
            'name' => htmlspecialchars($name),
            'price' => htmlspecialchars($price),
            'img' => $new_img_name
        ];

        $insert = "INSERT INTO store (name, price, img)
        values(:name, :price, :img)";

        $statement = $database_connection->prepare($insert);

        $statement->execute($messageData);
    } else {
        phpAlert("There wen't something wrong. Try again later.");
    }

    if(isset($_POST['userSubmit'])) {
        $name = $_POST['username'];
        $password = $_POST['password'];
        $checkPassword = htmlspecialchars($password);
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

        $userData = [
            'username' => htmlspecialchars($name),
            'password' => $password
        ];

        $insertUser = "INSERT INTO users (username, password)
        values(:username, :password)";

        $statementUser = $database_connection->prepare($insertUser);

        $statementUser->execute($userData);
    }

    if (isset($_GET['delete-item'])) {
        $id = ((int)$_GET["delete-item"]);

        $sql = "DELETE FROM store WHERE id=?";
        $stmt= $database_connection->prepare($sql);
        $stmt->execute([$id]);
    }

    if (isset($_GET['delete-user'])) {
        $id = ((int)$_GET["delete-user"]);

        $sql = "DELETE FROM users WHERE id=?";
        $stmt= $database_connection->prepare($sql);
        $stmt->execute([$id]);
    }

    $usernameCookie = $_COOKIE['Login-admin'];

    echo "<div class='navbar'>
    <img src='../assets/favicon.png' alt=''>
    <h1>Welcome $usernameCookie</h1>
    <i class='fa-solid fa-house' onclick='home()'></i>     
    <i onclick='logout()' class='fa-solid fa-arrow-right-from-bracket'></i>
    </div>"

    
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/e6d99cb95a.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- <section> -->
    

    <div class="buttons">
        <button onclick="itemAdd()">Item toevoegen</button>
        <button onclick="itemDelete()">Item verwijderen</button>
        <button onclick="userAdd()">Gebruiker toevoegen</button>
        <button onclick="openUserAdd()">Gebruiker lijst</button>
    </div>

    <div class="form add_item" id="add_form" enctype="multipart/form-data">
        <i class="fa-solid fa-x" onclick="closeLogin(2)"></i>
        <h1>Toevoegen</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="titel">Titel</label> <br>
            <input type="text" name="titel" id="titel"> <br>
            <label for="prijs">Prijs</label> <br>
            <input type="text" name="prijs" id="prijs"><br>
            <input type="file" name="my_image"> <br><br>
            <input type="submit" name="itemSubmit" value="Toevoegen"> <br> <br>
        </form>
    </div>

    <div class="items">
        <i id="closeVerwijderen" class="fa-solid fa-x" onclick="closeDelete()"></i>
        <?php
            $query = $database_connection->query("SELECT * FROM store");

            while($row = $query->fetch()) {
                echo "<div class='item'><span class='teksten'>" . $row['id'] . "<br> Naam: " . $row['name'] . "<br> Prijs: €". $row['price'] . "<br></span><a href='?delete-item=" . $row['id'] . "' class='buttonDelete' id='item-" . $row['id'] . "'>Delete</a><br></div> <br>\n";
            };
        ?>
    </div>  

    <div class="users">
        <i id="closeUsers" class="fa-solid fa-x" onclick="closeUserAdd()"></i>
        <?php
            $query = $database_connection->query("SELECT * FROM users");

            while($row = $query->fetch()) {
                echo "<div class='item'><span class='teksten'>" . $row['id'] . "<br> Naam: " . $row['username'] . "<br> Password: " . $row['password'] . " <br></span><a href='?delete-user=" . $row['id'] . "' class='buttonDelete' id='user-" . $row['id'] . "'>Delete</a><br></div> <br>\n";
            };
        ?>
    </div> 
    
    <div class="form add_user" id="add_user">
        <i class="fa-solid fa-x" onclick="closeLogin(3)"></i>
        <h1>Toevoegen</h1>
        <form action="" method="post">
            <label for="username">Gebruikersnaam</label> <br>
            <input type="text" name="username" id="username1"> <br>
            <label for="password">Wachtwoord</label> <br>
            <input type="text" name="password" id="password"><br> <br>
            <input type="submit" name="userSubmit" value="Toevoegen"> <br> <br>
        </form>
    </div>
    <!-- </section> -->

 
    <script src="../assets/js/script.js"></script>
</body>
</html>