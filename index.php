
<script src='./assets/js/script.js'></script>
<?php
    include_once("./include.php");
    if(isset($_POST['submit'])) {
        $email = $_POST['email_login'];
        $password = $_POST["password_login"];

        $query = 'SELECT * FROM users WHERE (email = :email)';
        $values = [':email' => $email];
        $statement = $database_connection->prepare($query); 
        $statement->execute($values);  
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (is_array($row))
        {
          if (password_verify($password, $row['password']))
          {
            if($row['is_admin'] == 1) {
                echo "<script>confirmAction('" . $row['firstname'] . "')</script>";
            } else {
                setcookie("Login", $row['firstname'], );
                header("Location: ./myaccount/");
            }

        } 
        } else {
            phpAlert("Username or password is incorrect");
          }
    }

    if(isset($_POST['register_submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if($password == $confirmPassword) {
            $checkPassword = htmlspecialchars($password);
            $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

            $userData = [
                'firstname' => htmlspecialchars($firstname),
                'lastname' => htmlspecialchars($lastname),
                'email' => htmlspecialchars($email),
                'password' => $hashedPassword,
                'is_admin' => 0
            ];
    
            $insertUser = "INSERT INTO users (firtsname, lastname, email, password, is_admin)
            values(:firstname, :lastname, :email, :password, :is_admin)";
    
            $statementUser = $database_connection->prepare($insertUser);
    
            $statementUser->execute($userData);
        } else {
            phpAlert("your passwords do not match");
        }
    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/e6d99cb95a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="navbar">
        <img src="./assets/favicon.png" alt="">
        <h1>Berle Shop</h1>
        <i class="fa-solid fa-person" onclick="login()"></i>
        <i class="fa-solid fa-cart-shopping" onclick="alert('This function is in development. Stay tuned!')"></i>
    </div>
    
    <div class="form login" id="login_form">
        <i class="fa-solid fa-x" onclick="closeLogin(1)"></i>
        <h1>login</h1>
        <form action="" method="post">
            <label for="email_login">E-Mail adress</label> <br>
            <input type="email" name="email_login" id="email_login" required=true> <br>
            <label for="password_login">Password</label> <br>
            <input type="password" name="password_login" id="password_login" required=true><br> <br>
            <input type="submit" name="submit" value="Inloggen"> <br>
            <p>Geen account? <a onclick="openRegister()">regsitreer</a></p> <br> 
        </form>
    </div>

    <div class="form register" id="register_form">
        <i class="fa-solid fa-x" onclick="closeLogin(4)"></i>
        <h1>Register</h1>
        <form action="" method="post">
            <label for="firstname">Firstname</label> <br>
            <input type="text" name="firstname" id="firstname" required=true> <br>
            <label for="lastname">Lastname</label> <br>
            <input type="text" name="lastname" id="lastname" required=true> <br>
            <label for="email">E-mail adress</label> <br>
            <input type="email" name="email" id="email" required=true> <br>
            <label for="password">Password</label> <br>
            <input type="password" name="password" id="password" required=true><br>
            <label for="confirm_password">Confirm password</label> <br>
            <input type="password" name="confirm_password" id="confirm_password" required=true><br> <br>
            <input type="submit" name="register_submit" value="Registreren"> <br> <br>
        </form>
    </div>

    <div class="boxes">
        <?php
        $query = $database_connection->query("SELECT * FROM store ORDER BY id DESC");

        while($row = $query->fetch()) {
            echo "<div class='box'> <button class='favorite' onclick='alert(`This function is in development. Stay tuned!`)'><i class='fa-solid fa-heart'></i></button> <img src='./assets/images/product-images/" .$row['img'] . "' alt='" . $row['name'] . "-img'> <h2>" . $row['name'] . "</h2> <p>€" . $row['price'] . "</p> <button class='add-to-cart' onclick='alert(`This function is in development. Stay tuned!`)'><i class='fa-solid fa-cart-shopping'></i></button></div> <br>\n";
        };
        ?>
    </div>
</body>
</html>