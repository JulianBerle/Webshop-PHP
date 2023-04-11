
<script src='./js/script.js'></script>
<?php
    // echo "<script src='./js/script.js'></script>";
    include_once("./include.php");
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST["password"];

        $query = 'SELECT * FROM users WHERE (username = :username)';
        $values = [':username' => $username];
        $statement = $database_connection->prepare($query); 
        $statement->execute($values);  
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (is_array($row))
        {
          if (password_verify($password, $row['password']))
          {
            if($row['is_admin'] == 1) {
                echo "<script>confirmAction('$username')</script>";
            } else {
                setcookie("Login", $username, );
                header("Location: ./panel.php");
            }

        } else {
            phpAlert("Username or password is incorrect");
          }
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
    <link rel="stylesheet" href="./css/style.css">
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
            <label for="username">Username</label> <br>
            <input type="text" name="username" id="username"> <br>
            <label for="password">Password</label> <br>
            <input type="password" name="password" id="password"><br> <br>
            <input type="submit" name="submit" value="Inloggen"> <br>
            <p>Geen account? <a href="">regsitreer</a></p> <br> 
        </form>
    </div>

    <div class="boxes">
        <?php
        $query = $database_connection->query("SELECT * FROM store ORDER BY id DESC");

        while($row = $query->fetch()) {
            echo "<div class='box'> <button class='favorite' onclick='alert(`This function is in development. Stay tuned!`)'><i class='fa-solid fa-heart'></i></button> <img src='uploads/" .$row['img'] . "' alt='" . $row['name'] . "-img'> <h2>" . $row['name'] . "</h2> <p>€" . $row['price'] . "</p> <button class='add-to-cart' onclick='alert(`This function is in development. Stay tuned!`)'><i class='fa-solid fa-cart-shopping'></i></button></div> <br>\n";
        };
        ?>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>