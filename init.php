<?php
/*
in this section we create a initals for some 
functions to help us to short the code and 
get the files very easy

its optional to creat or not 
--> first we creat a path for css, js and templates
*/

// include database for the connection
include 'PDO.php';


//creating  routes
$des ='includes/admin_controller/';
$loc ='index.php/'; // get the left sidebar locations
$tpl  ='includes/templates/'; //location of templates to get the header, footer and functions
$image ='assets/img/'; //location of img file to get the  pictures
$admin_css ='assets/admin/'; //location of admin file to get the  css
$css ='assets/admin/'; //location of css file
$js   ='assets/js/'; //location of js
$csss ='includes/layout/css/'; //location of css

$jss ='includes/layout/js/'; //location of js
$orders='includes/admin_controller/';
$func = 'includes/functions/'; // functions dirctory
$func ='includes/functions/'; // functions dirctory

//include the important files
include $func.'functions.php'; // get the function
include $tpl .'header.php';// include the header

if(!isset($noNavbar)){// we use it to incloude the navbar whereever we want except some pages
include $tpl .'header.php';  // include the navbar
}
?>
