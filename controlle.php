<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
// check if the username is correct then show dashboard

$pageTitle = 'User Controller'; // title of the page get by function
include 'init.php'; // this is what we made in init.php to get the url of template
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
    // Delete The User

    /**
     *
     *  Start the page to see the all users
     *  this page has few mistiks such as security so far
     *
     *
     */


    // Start Dashborad page

    $do = '';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'views';
    } ?>
<?php if ($do == 'admin') {


    ?>

<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>
<div class="content mt-3">
    <div class="col-sm-12 col-lg-12 ">
        <!--Content-->
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

                                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab"
                                        href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All
                                    </a>

                                    <a class="nav-item nav-link" id="nav-Teacher-tab" data-toggle="tab"
                                        href="#nav-Teacher" role="tab" aria-controls="nav-Teacher"
                                        aria-selected="false">Admins</a>
                                    <a class="nav-item nav-link" id="nav-Student-tab" data-toggle="tab"
                                        href="#nav-Student" role="tab" aria-controls="nav-Student"
                                        aria-selected="false">Markting</a>
                                    <a class="nav-item nav-link" id="nav-Moderator-tab" data-toggle="tab"
                                        href="#nav-Moderator" role="tab" aria-controls="nav-Moderator"
                                        aria-selected="false">Users</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                    aria-labelledby="nav-all-tab">

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">ALL USERS</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- prepare the database to get the information -->
                                                        <?php

                                                                $stmt2 = $con->prepare("SELECT * From user,postion 
                                                                        where Status > 0 
                                                                        and user.role_id = postion.role_id
                                                                        order by postion.role_id Desc");
                                                                $stmt2->execute();
                                                                $users = $stmt2->fetchAll(); ?>

                                                        <?php if ($users > 0) {
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

                                                            <?php if ($user['role_name'] != 'admin') {  ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php  } else {
                                                                                echo ' <td>Sorry you Can NOT Do Actions against Admins</td>';
                                                                            } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Teacher" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Admins</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                                                        where Status > 0 
                                                                        and user.role_id = postion.role_id
                                                                        and postion.role_name ='admin'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                            <?php if ($user['role_name'] != 'admin') {  ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php  } else {
                                                                                echo ' <td>Block Actions</td>';
                                                                            } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Student" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Markting</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                                                        where Status > 0 
                                                                        and user.role_id = postion.role_id
                                                                        and postion.role_name ='Markting'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                            <?php if ($user['role_name'] != 'admin') {  ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php  } else {
                                                                                echo ' <td>admins page</td>';
                                                                            } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Moderator" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Users</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                                                        where Status > 0 
                                                                        and user.role_id = postion.role_id
                                                                        and postion.role_name ='user'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                            <?php if ($user['role_name'] != 'admin') {  ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php  } else {
                                                                                echo ' <td>admins page</td>';
                                                                            } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class =" warrning alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php } // End the Admin page
    if ($do == 'Markting') { ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>
<div class="content mt-3">
    <div class="col-sm-12 col-lg-12 ">
        <!--Content-->
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

                                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab"
                                        href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All
                                    </a>

                                    <a class="nav-item nav-link" id="nav-Teacher-tab" data-toggle="tab"
                                        href="#nav-Teacher" role="tab" aria-controls="nav-Teacher"
                                        aria-selected="false">Admins</a>
                                    <a class="nav-item nav-link" id="nav-Student-tab" data-toggle="tab"
                                        href="#nav-Student" role="tab" aria-controls="nav-Student"
                                        aria-selected="false">Markting</a>
                                    <a class="nav-item nav-link" id="nav-Moderator-tab" data-toggle="tab"
                                        href="#nav-Moderator" role="tab" aria-controls="nav-Moderator"
                                        aria-selected="false">Users</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                    aria-labelledby="nav-all-tab">

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">ALL USERS</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- prepare the database to get the information -->
                                                        <?php

                                                                $stmt2 = $con->prepare("SELECT * From user,postion 
                                        where Status > 0 
                                        and user.role_id = postion.role_id
                                        order by postion.role_id Desc");
                                                                $stmt2->execute();
                                                                $users = $stmt2->fetchAll(); ?>

                                                        <?php if ($users > 0) {
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

                                                            <?php if ($user['role_name'] != 'admin' || $user['role_name'] == 'Markting' || $user['role_name'] != 'user') {  ?>

                                                            <?php echo ' <td>Block Actions</td>';
                                                                            } else { ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Teacher" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Admins</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                        where Status > 0 
                                        and user.role_id = postion.role_id
                                        and postion.role_name ='admin'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                                <?php if ($user['role_name'] == 'admin') {  ?>
                                                            <td>
                                                                <?php echo ' <td>Block Actions</td>'; ?>

                                                                <?php  } else { ?>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>

                                                            <?php } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Student" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Markting</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                        where Status > 0 
                                        and user.role_id = postion.role_id
                                        and postion.role_name ='Markting'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                            <?php if ($user['role_name'] == 'Markting') {
                                                                                echo ' <td>Block Actions</td>';
                                                                            } else { ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                        confirm">Delete
                                                                        </button></a>
                                                                </div>

                                                            </td>
                                                            <?php } ?>
                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- This part for what markting users can only can see  -->
                                <div class="tab-pane fade" id="nav-Moderator" role="tabpanel"
                                    aria-labelledby="nav-Teacher-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title">Users</strong>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-2">First Name</th>
                                                            <th class="col-2">Last Name</th>
                                                            <th class="col-3">Phone Number</th>
                                                            <th class="col-3">Email</th>
                                                            <th class="col-3">Postion</th>
                                                            <th class="col-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start the Database to get the information of products -->
                                                        <?php
                                                                $stmt3 = $con->prepare("SELECT * From user,postion 
                                        where Status > 0 
                                        and user.role_id = postion.role_id
                                        and postion.role_name ='user'");
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
                                                                $stmt3->execute();
                                                                $users = $stmt3->fetchAll();
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

                                                            <?php if ($user['role_name'] == 'user') {

                                                                                echo ' <td>Block Actions</td>';
                                                                            } else { ?>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-lg-none"><i
                                                                                class="fa fa-edit"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-primary d-none d-lg-block confirm">Modify
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-lg-none"><i
                                                                                class="fa fa-ban"></i></button><button
                                                                            type="button"
                                                                            class="btn btn-outline-danger d-none d-lg-block confirm">Ban
                                                                        </button></a>

                                                                    <a onclick="return ban_confirmation('<?= $user['user_Fname']; ?>')"
                                                                        href="important_user_controle.php?do=Delete&user_id=<?= $user['user_id'] ?> "><button
                                                                            type="button" name="Delete"
                                                                            class="btn btn-outline-secondary d-lg-none"><i
                                                                                class="fa-minus-circle"></i></button><button
                                                                            type="button" name="Delete" class="btn btn-outline-secondary d-none d-lg-block
                                        confirm">Delete
                                                                        </button></a>
                                                                </div>
                                                            </td>
                                                            <?php } ?>

                                                        </tr>

                                                    </tbody>

                                                    <?php } // End Foreach
                                                                } else {
                                                                    echo '<div class ="warrning  alert alert-danger">There is no Data to show</div> ';
                                                                } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    }
    if ($do == 'user') {
        include 'sidebar.php';
        include $tpl . 'head_nav.php';
        echo '<div class="warrning  alert alert-danger">Sorry This page Avalibule For Admins And Markting ONLY </div> ';
    }
} else {
    echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';
}

include $tpl . 'footer.php';
?>
<!-- End the Main Page IF  -->
