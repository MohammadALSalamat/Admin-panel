<?php
session_start(); //start session
$pageTitle = 'Login'; // title of the page get by functio
include 'init.php'; // this is what we made in init.php to get the url of template
//check if the user coming from HTTP post Request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['user']; // get the user name
    $password = $_POST['pass']; // get the password
    // chech if the user exist in database
    $stmt = $con->prepare('SELECT user_id , Email ,Password 
                          From user 
                          where Email = ?
                          and Password = ?
                          and Status = 1
                          ');  // prepare the data base to be shown
    // print the data 
    $stmt->execute(array($username, $password));
    $row = $stmt->fetch(); // bring the data from database
    $count = $stmt->rowCount(); // check the number of rows that deal with data
    // if count > 0 then database has record
    if ($count > 0) {
        $_SESSION['Email'] = $username; // register the name to session
        $_SESSION['Aid'] = $row['user_id'];
        $_SESSION['pass'] = $password; // register the User_id to session
        header('Location: dashboard.php');
        exit();
    } else {

        echo '<div class=" warrning alert alert-danger">Sorry Somthing Went Wrong <ol>  <li>  Your account is <b> BANNED </b> . So You Can Not Enter. Please Contact with Admins</li> <b> OR </b> <li>  <b>  Check Your User Name And Password </b> </li>  </ol>  </div>';
    }
}

?>
<!--
Start the HTML section 
-->
<form class='login' action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class='text-center'> Admin Login </h4>
    <input type="hidden" name='userID' value="<?php echo $row['user_id'] ?>">
    <input class='form-control' type="email" name='user' placeholder='Username' autocomplete>
    <input class='form-control' type="password" name='pass' placeholder='password' autocomplete>
    <input class='btn btn-primary btn-block' type="submit" name='login' value=' LOGIN'>

</form>