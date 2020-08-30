<?php
/*
this section to connect to database

*/

// define the database 
$dsn = 'mysql:host=localhost;port=3306;dbname=healtopedia';
$user = 'root';
$pass = 'root';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

// try to catch the error if the connect failed
try {
    $con = new PDO($dsn, $user, $pass, $option); // connect to database
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//handel the error if there is one 
catch (PDOException $e) {
    echo 'Failed to connect' . $e->getMessage();
}
