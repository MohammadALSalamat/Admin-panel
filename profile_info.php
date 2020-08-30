<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
$pageTitle = 'categories page'; // title of the page get by function

include 'init.php'; // this is what we made in init.php to get the url of template
// check if the username is correct then show dashboard
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
    $userID = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid']) ? intval($_SESSION['Aid']) : 0;
    $stam = $con->prepare("SELECT * 
                            from user
                            where user_id = ?
                            ");
    $stam->execute(array($userID));
    $users = $stam->fetchAll();
    foreach ($users as $user) {
    }

?>


<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Profile Info </h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Personal info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Change Password</a>
                    </li>

                </ul>
                <div class="tab-content pl-3 p-1" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label"> First Name :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <a href="#" data-name="user_name" data-type="text"
                                    data-url="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "
                                    class="data-modify-support no-style"><?= $user['user_Fname'] ?></a>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label"> Last Name :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <a href="#" data-name="user_name" data-type="text"
                                    data-url="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "
                                    class="data-modify-support no-style"><?= $user['user_Lname'] ?></a>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Phone :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <a href="#" data-name="phone" data-type="text"
                                    data-url="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "
                                    class="data-modify-support no-style"><?= $user['Phone'] ?></a>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Email :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <a href="#" data-name="email" data-type="text"
                                    data-url="important_user_controle.php?do=modify&user_id=<?= $user['user_id'] ?> "
                                    class="data-modify-support no-style"><?= $user['Email'] ?></a>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12" align="center">
                            <a class="btn btn-primary modify" name="modify-support"
                                href="important_user_controle.php?do=modifyUser&user_id=<?= $user['user_id'] ?> "><i
                                    class="fa ti-pencil"></i> Modify</a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="" role="form" class="form-horizontal">

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Current Password
                                        :</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="password" placeholder="Old Password" class="form-control"
                                        required="required">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">New Password :</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="password" placeholder="New Password" class="form-control"
                                        required="required">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Re-type New Password :</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="col-12 col-md-8">
                                        <input type="password" placeholder="Re-type New Password" class="form-control"
                                            required="required">
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php } else {
    echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';
} ?>

<?php include $tpl . 'footer.php' ?>
