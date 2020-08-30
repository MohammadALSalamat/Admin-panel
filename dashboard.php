<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
$pageTitle = 'Dashboard'; // title of the page get by function


include 'init.php'; // this is what we made in init.php to get the url of template
// check if the username is correct then show dashboard
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {


    // Start Dashborad page

    include 'sidebar.php';

    include $tpl . 'right_panel.php';

    include $tpl . 'footer.php';
} else {
    echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';
}
