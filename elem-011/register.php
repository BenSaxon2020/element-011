<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="stylesheets/main-style.css">
        <title>Element 011 | Register</title>
    </head>
    <body>
    <div class="p p-1"></div>
    <div class="p p-2"></div>
    <div class="p p-3"></div>    
    <div class="p p-4"></div>
    <div class="p p-5"></div>
    <div class="p p-6"></div>
    <div class="p p-7"></div>          
    <div class="p p-8"></div>
    <div class="p p-9"></div>
    <div class="p p-10"></div>
    <div class="p p-11"></div>
    <div class="p p-12"></div>
  <nav>
    <ul>
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>

    </ul>
</nav>
        <div>
            <h1 class="center">Register</h1> 
            <div class="center">
                <!-- <p1>Login</p1> -->
                <form action="./register.php" method="post">
                    <input type="text" id="user" name="User" placeholder="Username" required>

                    <input type="email" id="email" name="Email" placeholder="Email" required>

                    <input type="password" id="pass" name="Pass" placeholder="Password" required>

                    <input class="button button1" type="submit" value="Register">
            </div>
           
        </div>
    </body>
</html>


<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if(isset($_SESSION['user'])) // If session is not set then redirect to Login Page
       {
           header("Location:auth_passed.php");  
       }


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $_POST["User"] = NULL;
// $_POST["Email"] = NULL;
// $_POST["Pass"] = NULL;



$user = $_POST["User"];
$email = $_POST["Email"];
$pass = $_POST["Pass"];

if ($user and $email != "NULL"){
$sql = "SELECT * FROM users WHERE Username='$user' or Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows >= 1) {
  // output data of each row
    echo "<h1>Username or Email taken.</h1>";
  } else {
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $SQL_INSERT = "INSERT INTO users (Username, Email, Password) VALUES (?,?,?)";
    $stmt = $conn->prepare($SQL_INSERT);

    if($stmt = $conn->prepare($SQL_INSERT)) {        
        $stmt->bind_param('sss', $user, $email, $pass);
        $stmt->execute();

        // mail("ben.saxon21@gmail.com","My subject","this is an email from php");
        header("Location:http://localhost/uni/elem-011/login.php");
        
    } else {
        $error = $db_found->errno . ' ' . $db_found->error;
        echo $error;
  }
}
}
$conn->close();
?>
