<?php
/*
this secction is to create a dinamic functions 

1-) get the title if there is any title otherwise echo defualt title

*/

function getTitle(){

    global $pageTitle;

    if(isset($pageTitle)){
        
        echo $pageTitle;
    }else {
        echo ' defualt';
    }
}


/*

* this functon to get all the information from the tables

*/

function getAll( $select , $table){
    global $con;

    $stmt2 = $con->prepare("SELECT $select 
                            From $table
                             ");
    $stmt2->execute();
    return $stmt2->fetchColumn();
    
}

/*

** after updating this function now it  could do anything{ e.x : Error , message , warning} 

*/

function handleError($theMsg,$url =null ,$seconds=1){
    // check the url of the page
if ($url === null){
      $url = $_SERVER['SCRIPT_NAME'];
}else{
    $url =  isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ' ' ?  $_SERVER['HTTP_REFERER'] : 'controlle.php';
  }

echo $theMsg ;
header("refresh: $seconds; url=$url");
exit();

}

/*
** this function to check the database
** if there is any dplicate data then return 
** message that user has this item or name 
*/

function checkUsers($select ,$from ,$value){
    global $con;
    $stmtCheck =$con-> prepare("SELECT $select 
                                from $from 
                                where $select = ?");
   $stmtCheck->execute(array($value));
    $count = $stmtCheck-> rowCount();
    return $count;
    
}
function checkrole($select ,$from ,$value){
    global $con;
    $stmtCheck =$con-> prepare("SELECT $select 
                                from $from 
                                where role_id = ?");
   $stmtCheck->execute(array($value));
    $users =$stmtCheck->fetchAll();
    return $users;
    
}
function checkID($select ,$from ,$value){
    global $con;
    $stmtCheck =$con-> prepare("SELECT $select 
                                from $from 
                                where user_id = ?");
   $stmtCheck->execute(array($value));
    $users =$stmtCheck->fetchAll();
    return $users;
    
}
/* Ban the user Functions */


/*
this function work to count the number of items such as [ count members , comments]

*/
function countMemb($item ,$table){
    global $con; // alwys make the connection globle

    $stmt2 = $con->prepare("SELECT count($item) From $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

/*
this function count the latest user [users , items , comments]

*/

function getLatest($select ,$table , $order, $limit = 3 ){
    global $con;
    $getStat = $con->prepare("SELECT * from $table  ORDER BY $order DESC limit $limit ");
    $getStat->execute();
    $row = $getStat->fetchAll();
    return $row;
}
/*
this function count the latest item [users , items , comments]

*/
function getLatestitem($select , $table , $order, $limit = 3 ){
    global $con;
    $getStat = $con->prepare("SELECT * from  $table  ORDER BY $order DESC limit $limit ");
    $getStat->execute();
    $row = $getStat->fetchAll();
    return $row;
}
?>
