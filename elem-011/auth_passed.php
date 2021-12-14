<?php
error_reporting(E_ERROR | E_PARSE);

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "messages";


$conn = new mysqli($servername, $user, $password, $dbname);
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
echo'<p1>Welcome ' . $_SESSION['user'] . '</p1>';
echo '</div>';
echo "
    <div class='center'> 
        <h1>
            Your most recent messages:
        </h1>

    </div>";
    $user = $_SESSION["user"];
    $sql = "SELECT * FROM mes WHERE user='$user'";
    $result = mysqli_query($conn,$sql); 
        while ($row = mysqli_fetch_array($result)) {
            echo "
                <div class='card'>
                <h1>" . $row['user'] . " | " . date('h:i:s d/m/Y', $row['timestamp']) . " </h1>
                <p1>" . $row['message'] . "</p1>
                <br>
                <p1>Likes: ". $row['likes'] . "</p1>


                <form action=./auth_passed.php method=POST>
                <input type='hidden' id='msgid' name='msgid' value=' " . $row['messageid'] . "'>
                <input type='submit' id='del' name='del' value='Delete message'>
                </form>

                <!-- | hour minute second if stamp withing 24 hrs of current stamp else show day month year etc -->
                </div>
            ";
        }

if (isset($_POST["msgid"])){
    echo($_POST["msgid"]);
    $msgid = $_POST["msgid"];
    $sql = "DELETE FROM mes WHERE messageid='$msgid'";
    $result = mysqli_query($conn,$sql);
    header("Location:auth_passed.php");  

}




echo'
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
';

echo "</body>";
echo "</html>";
?>