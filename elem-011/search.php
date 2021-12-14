<?php
error_reporting(E_ERROR | E_PARSE);
echo '<link rel="stylesheet" href="stylesheets/main-style.css">';

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "messages";

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

$conn = new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

echo"
<form action=search.php method=post>
<input type=text name=username placeholder='Enter Username and press enter to search'>
</form>
";
$username=$_POST['username'];

$sql = "SELECT * FROM mes WHERE user LIKE '%$username%'";
$result = mysqli_query($conn,$sql); 
    while ($row = mysqli_fetch_array($result)) {

        echo "
            <div class='card'>
            <h1>" . $row['user'] . " | " . date('h:i:s d/m/Y', $row['timestamp']) . " </h1>
            <p1>". $row['message'] . "</p1>
            <!-- | hour minute second if stamp withing 24 hrs of current stamp else show day month year etc -->
            </div>

        ";
    }
?>
