<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

session_start();
if(!isset($_SESSION['user'])) // If session is not set then redirect to Login Page
       {
           header("Location:login.php");  
       }


echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' href='stylesheets/main-style.css'>";


echo "</head>";
echo "<body>";
echo "<nav>";
echo "<ul>";
echo "<li><a class='active' href='index.html'>Home</a></li>";
echo "<li><a href='login.php'>Login</a></li>";
echo "<li><a href='register.php'>Register</a></li>";
echo "<li><a href='messaging.php'>messaging</a></li>";
echo "<li><a href='search.php'>search messages</a></li>";
echo "<li class='right-f'><a href='logout.php'>Logout</a></li>";

echo '<li class="ddown right-f">';
echo '<a href="auth_passed.php" class="dropbtn">Logged in as: ' . $_SESSION['user'] .'</a>';
echo '<div class="ddown-content">';
echo '<a href="profile.php">Profile</a>';
echo '</div>';
echo '</li>';
echo "</ul>";
echo "</nav>";
echo "<div class='center'>";
echo '</div>';
echo '</li>';


// echo "<li class='right'><a class='right'>Logged in as: " . $_SESSION['user'] . "</a></li>";
echo "</ul>";
echo "</nav>";
echo "<div class='center'>";
echo "                
    <form action='' method='post'>
        <label for='oldpass'>Old Password: </label>
        <input type='password' id='oldpass' name='oldpass' placeholder='Old Password'>
        <br>
        <label for='newpass'>New Password: </label>
        <input type='password' id='newpass' name='newpass' placeholder='New Password'>
        <br>
        <input class=' button1' type='submit' value='Update Password'>
    </form>";

echo '<div class="p p-1"></div>
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
    <div class="p p-12"></div>';

echo "</div>";
echo "</body>";
echo "</html>";



$oldpass = $_POST["oldpass"];
$newpass = $_POST["newpass"];
$user = $_SESSION['user'];

if ($oldpass and $newpass != "NULL" or "null" or ""){



    $newpass=password_hash($newpass, PASSWORD_DEFAULT);
    $sql = "SELECT Password FROM users WHERE Username='$user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = mysqli_fetch_array($result))
            $hashed_pass = $row['Password'];
        if (password_verify($oldpass, $hashed_pass)){
            $sql = "UPDATE users SET Password='$newpass' where Username='$user'";
            $result = $conn->query($sql);
            echo "<p1>Password Updated</p1>";
        }
    }
    else{
        echo "<p1>Password Update failed</p1>";    
    }
}

$conn->close();


?>