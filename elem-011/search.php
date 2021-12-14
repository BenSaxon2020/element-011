<?php

echo '<link rel="stylesheet" href="stylesheets/main-style.css">';

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "messages";


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
