<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
     $pageTitle= 'categories page'; // title of the page get by function

    include 'init.php'; // this is what we made in init.php to get the url of template
// check if the username is correct then show dashboard
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
 $userID = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid'])?intval($_SESSION['Aid']):0;
  $stmt2 = $con->prepare("SELECT * From user,postion 
                         where Status > 0 
                        and user.role_id = postion.role_id
                        and user_id =$userID 
                        order by postion.role_id Desc");
                        $stmt2->execute();
                        $users =$stmt2->fetchAll();     
                        if ($users > 0) {
                        foreach ($users as $user) {
                         
                         }
                         }
                         
if($user['role_id'] == 3 || $user['role_id'] == 2 ){ ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl.'head_nav.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>categories List</h4>

            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all"
                                role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                            aria-labelledby="nav-all-tab">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">All categories</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">logo</th>
                                                    <th class="col-2">Categories</th>
                                                    <th class="col-5">Description</th>
                                                    <th class="col-3">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!-- Start the Database to get the information of products -->
                                                <?php
                                                $stmt2 = $con->prepare("SELECT *
                                                 From category ");
                                                 $stmt2->execute();
                                                $cats =$stmt2->fetchAll();     
                                                if ($cats > 0) {
                                                foreach ($cats as $cat) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="uploads/avatars/<?= $cat['avater'] ?>"
                                                            alt=" NO AVATAR ">
                                                    </td>
                                                    <td>
                                                        <?php echo $cat['cat_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $cat['description'] ?>
                                                    </td>

                                                    <td>
                                                        <div class=" btn-group" role="group">

                                                            <a onclick="return ban_confirmation('<?=$cat['proc_name'];?>')"
                                                                href="important_user_controle.php?do=catEdit&cat_id=<?= $cat['cat_id'] ?> "><button
                                                                    type=" button"
                                                                    class="btn btn-outline-success d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button"
                                                                    class="btn btn-outline-success d-none d-lg-block confirm">Edit
                                                                    <i class="fa fa-edit"></i>
                                                                </button></a>

                                                            <a onclick="return ban_confirmation('<?=$cat['proc_name'];?>')"
                                                                href="important_user_controle.php?do=catDelet&cat_id=<?= $cat['cat_id'] ?> "><button
                                                                    type=" button" name="Delete"
                                                                    class="btn btn-outline-danger d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button" name="Delete"
                                                                    class="btn btn-outline-danger d-none d-lg-block confirm">Delete
                                                                    <i class="fa fa-close" aria-hidden="true"></i>
                                                                </button></a>
                                                        </div>
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
    </div>
</div>
<?php 
}
else{
    include 'sidebar.php' ;

include $tpl.'head_nav.php'; 
    echo '<div class="warrning  alert alert-danger">Sorry This page ONLY For Admins And Markting Team </div> ';
} 
}

else{
echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';

}?>
<!-- End the Main Page IF  -->
<?php include $tpl.'footer.php' ?>
