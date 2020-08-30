<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
     $pageTitle= 'User Controller'; // title of the page get by function

    include 'init.php'; // this is what we made in init.php to get the url of template
// check if the username is correct then show dashboard
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {

       $do ='';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do ='views';
    }
?>
<?php if($do == 'admin'){ ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl.'head_nav.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>User List</h4>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link" id="nav-banned-tab" data-toggle="tab" href="#nav-banned"
                                role="tab" aria-controls="nav-banned" aria-selected="false">Banned Users</a>


                        </div>
                    </nav>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">banned user</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-2">First Name</th>
                                            <th class="col-2">Last Name</th>
                                            <th class="col-3">Phone Number</th>
                                            <th class="col-3">Email</th>
                                            <th class="col-3">Position</th>
                                            <th class="col-4">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php   
                                                 $stmt2 = $con->prepare("SELECT * From user,postion 
                                                                            where Status = 0 
                                                                            and user.role_id = postion.role_id
                                                                            order by postion.role_id Desc");
                                                            $stmt2->execute();
                                                            $users =$stmt2->fetchAll();
                                        if ($users > 0) {
                                        foreach ($users as $user) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $user['user_Fname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $user['user_Lname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $user['Phone'] ?>
                                            </td>
                                            <td>
                                                <?php echo $user['Email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $user['role_name'] ?>
                                            </td>
                                            <td>
                                                <a onclick="return are_you_sure()"
                                                    href="important_user_controle.php?do=Active&user_id=<?= $user['user_id'] ?> ">
                                                    <button type="button" class="btn btn-outline-success d-lg-none"><i
                                                            class="fa fa-ban"></i></button><button type="button"
                                                        class="btn btn-outline-success d-none d-lg-block">Unban</button>

                                                </a>
                                            </td>
                                        </tr>


                                        <?php                       
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }else{
include 'sidebar.php' ;

include $tpl.'head_nav.php'; 
    echo '<div class="warrning  alert alert-danger">Sorry This page ONLY For Admins </div> ';
} ?>
<?php
}else{
echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';

}?>
<!-- End the Main Page IF  -->
<?php include $tpl.'footer.php' ?>
