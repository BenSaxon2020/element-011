<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="stylesheets/main-style.css"> <!--Implementing the css file to style th epage  -->
        <title>Element 011 | Login</title> 
        <!-- gives the page tab a title title  -->
    </head>
    <body>
        <!-- <div class="p gives styling and anamation infomation to the html elemnet and p-num gives further positioning information for where on the page to display the animation-->
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
    <!-- ------------------------- -->
    <!-- nav if the container for the nav bar at the top of the page that users use to interact with the web page -->
<nav>
    <!-- ul contains all the navbar elements and is an unorderd and non bulleted list container meaning its easyer to style and looks cleaner,
    the li tag means the item is a part of a list and a tags are used to give strings of text/information hyperlink properties   -->
    <ul>
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>

    </ul>
</nav>
<!-- div tags are used to group sets of elements for styling purposes and to keep the code looking clean divs also allow for sections on the page to be rules by a class with out affecting the rest
of the page  -->
        <div>
            <h1 class="center">Login</h1> 
            <div class="center">
                <!-- <p1>Login</p1> -->
                <!-- forms are used to send data to another page or to a scripts that can then be used to check login details, create a user or many other thing such as fill in variables
                 in an sql script
            the most common elements of a form tag are action and method; the action tag is used to specify where to the pass the data to and the method is what protocal to use such
             as GET or POST-->
            <!-- the label tag allows us to display next, above or somewhere near the input box what that input box is for same with the place holder value inside the input tag which 
            allows us to put some text inside the text box that tells the user what to enter inside it such as Username   -->
            <!-- html also allows us to utilise the use of input types that can change what the input is like type="text" means the input is just plane text but the password type does something special
            as it allows us to hide the input an changes what is shown to * which is a great privicy feature, the type submit creates a button that submits the form data to the action page secified with the 
            chosen method -->
                <form action="login.php" method="post">
                    <label for="user">Username:</label>
                    <input type="text" id="user" name="user" placeholder="Username">
                    <br>
                    <label for="pass">Password: </label>
                    <input type="password" id="pass" name="pass" placeholder="Password">
                    <br>
                    <input class="button button1" type="submit" value="Login">
            </form>
            </div>

        </div>
        
    </body>
</html>

<?php
error_reporting(E_ERROR | E_PARSE);
// error_reporting(E_ERROR | E_PARSE); allows us to hide any error messages or warning meessages created by php which not only makes out pages look clean but also hides any fead back from 
// the php server to a potential attack but this will only slow down and not stop someone with the correct skills and motivation


session_start();
// starts a session that be can store data in but unlike a cookie is doesnt store the data on a users computer which is one less security vulnerability

if(isset($_SESSION['user'])) // If the session has the variable user set as a username (there logged in ) it will redirect the to the main logged in page
       {
           header("Location:auth_passed.php");  
       }




// defining the sql server variables to be used in a moment to create an sql connection  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// define connection permaiters
$conn = new mysqli($servername, $username, $password, $dbname);
// initiate the connection and check if there is a connection error if there is kill the page and show the error message
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//here were getting the data defined in the form that was sent with the post protocal and assingining them to variables for easier invocation
$user = $_POST["user"];
$pass = $_POST["pass"];
// checking if both the variable user and pass are not empty and are strings (string sanitation)
if (is_string($user) and is_string($pass) == TRUE){
    // defining and setting the sql query to be stored in the variable $sql
    $sql = "SELECT Password FROM users WHERE Username='$user'";
    //running the sql query
    $result = $conn->query($sql);
// checking if there are any results and if there are running the code in the if statment
    if ($result->num_rows > 0){
// looping through the results
        while($row = mysqli_fetch_array($result))
        //alocating the returend password hash to the variable $hashed_pass
            $hashed_pass = $row['Password'];
            // checking if the hashed password stored matches the password entered to verify the users login credential if there is a match the user is logged in and setting the session variable $_SESSION['user']
            // as the users username then redirecting to the main pages for logged in users
        if (password_verify($pass, $hashed_pass)){
            echo "you are now logged in";
            $_SESSION['user'] = $user;
            echo "<br>" . $_SESSION['user'];
            header("Location:http://localhost/uni/elem-011/auth_passed.php");

        } else{
            // if the login failed then informing the user that the login failed
            echo "login failed";

        }
    } 
}
// closing the sql connection
$conn->close();




?>