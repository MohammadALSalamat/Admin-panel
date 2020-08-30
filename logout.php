<?php
//start the session
session_start();
//unset the data
session_unset();
//destroy the data and logout
session_destroy();
header('Location: index.php');
exit();