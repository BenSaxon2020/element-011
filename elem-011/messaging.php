<?php
error_reporting(E_ERROR | E_PARSE);

// $time1 = date("H:i:s");
$time = time();
$set_likes=0;
// $date1 = date("Y-m-d" $time);
session_start();
if(!isset($_SESSION['user'])) // If session is not set then redirect to Login Page
       {
           header("Location:login.php");  
       }

echo "

<!DOCTYPE html>
<html>
    <head>

        <link rel='stylesheet' href='stylesheets/main-style.css'>

    </head>
    <body>";
    echo "<nav>";
    echo "<ul>";
    echo "<li><a class='active' href='index.html'>Home</a></li>";
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='register.php'>Register</a></li>";
    echo "<li><a href='messaging.php'>messaging</a></li>";

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
    echo'<p1>Welcome ' . $_SESSION['user'] . '</p1>';
    echo '</div>';



$username = $_SESSION['user'];
$message = $_POST["Message"];

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "messages";


$conn = new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } if (!empty($message) and $message!= " " and $message != "" or null ){
  $SQL_INSERT = "INSERT INTO mes (timestamp, user, message , likes) VALUES (?,?,?,?)";
  $stmt = $conn->prepare($SQL_INSERT);

  if($stmt = $conn->prepare($SQL_INSERT)) {        
      $stmt->bind_param('ssss', $time, $username, $message, $set_likes);
      $stmt->execute();
      header("Location:messaging.php");  

  } else {
    }

  }




$sql = "SELECT * FROM mes";
// $result = mysql_query($sql);
$result = mysqli_query($conn,$sql); 
    while ($row = mysqli_fetch_array($result)) {
        // echo $row['message'];




        // query and search for messages by username
        echo "
            <div class='card'>
            <h1>" . $row['user'] . " | " . date('h:i:s d/m/Y', $row['timestamp']) . " </h1>
            <p1>". $row['message'] . "</p1>
            <!-- | hour minute second if stamp withing 24 hrs of current stamp else show day month year etc -->
            </div>

        ";
    }

            // to do 
            // add delete message function
            // add like button function
$conn->close();


echo "
    
    <div class='p p-1'></div>
    <div class='p p-2'></div>
    <div class='p p-3'></div>    
    <div class='p p-4'></div>
    <div class='p p-5'></div>
    <div class='p p-6'></div>
    <div class='p p-7'></div>          
    <div class='p p-8'></div>
    <div class='p p-9'></div>
    <div class='p p-10'></div>
    <div class='p p-11'></div>
    <div class='p p-12'></div>



        <div class='center'>
        <form action=messaging.php method=POST>
        <input type='text' name='Message' id='Message' class='card' placeholder='press enter to post required'>
        
        </form>
        </div>

        <!-- //to do:
        form to post messages 
        form to reply to messages
        like function 
        
        
        -->

    </body>
</html>

";

