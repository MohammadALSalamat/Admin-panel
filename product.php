<?php

ob_start('ob_gzhandler'); // output buffering start

session_start(); //start session
     $pageTitle= 'product Controller'; // title of the page get by function

    include 'init.php'; // this is what we made in init.php to get the url of template
    
// check if the username is correct then show dashboard
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
 $userID = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid'])?intval($_SESSION['Aid']):0;
  $stmt2 = $con->prepare("SELECT * From user,postion 
                         where Status > 0 
                        and user.role_id = postion.role_id
                        and user_id =$userID;
                        order by postion.role_id Desc");
                        $stmt2->execute();
                        $users =$stmt2->fetchAll();     
                        if ($users > 0) {
                        foreach ($users as $user) {
                      
                         }
                         }
                         
if($user['role_id'] == 3 || $user['role_id'] == 2 ){?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl.'head_nav.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>products List</h4>

            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all"
                                role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                            <a class="nav-item nav-link" id="nav-Teacher-tab" data-toggle="tab" href="#nav-Teacher"
                                role="tab" aria-controls="nav-Teacher" aria-selected="false">man's Product</a>
                            <a class="nav-item nav-link" id="nav-Teacher-tab" data-toggle="tab" href="#nav-Student"
                                role="tab" aria-controls="nav-Teacher" aria-selected="false">woman's Product</a>
                            <a class="nav-item nav-link" id="nav-Moderator-tab" data-toggle="tab" href="#nav-Moderator"
                                role="tab" aria-controls="nav-Moderator" aria-selected="false">Family's product</a>




                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                            aria-labelledby="nav-all-tab">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">All Products</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Avatar</th>
                                                    <th class="col-1">Name</th>
                                                    <th class="col-1">Price</th>
                                                    <th class="col-4">Hospital</th>
                                                    <th class="col-2">Categories</th>
                                                    <th class="col-1">Tags</th>
                                                    <th class="col-3">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!-- Start the Database to get the information of products -->
                                                <?php
                                                $stmt2 = $con->prepare("SELECT proc_id, proc_avatar,proc_name,price,cat_name,tag_name,host_name
                                                 From products, tags, category,hospital 
                                                 where products.cat_id = category.cat_id
                                                 and products.tag_id = tags.tag_id
                                                 and products.host_id = hospital.host_id");
                                                 $stmt2->execute();
                                                $users =$stmt2->fetchAll();     
                                                if ($users > 0) {
                                                foreach ($users as $user) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="uploads/avatars/<?php echo $user['proc_avatar'] ?>"
                                                            alt=" NO AVATAR ">
                                                    </td>
                                                    <td>
                                                        <?php echo $user['proc_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['price']. '$' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['host_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['cat_name'] ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $user['tag_name'] ?>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group" role="group">

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc_Edit&proc_id=<?= $user['proc_id'] ?> "><button
                                                                    type=" button"
                                                                    class="btn btn-outline-success d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button"
                                                                    class="btn btn-outline-success d-none d-lg-block confirm">Edit
                                                                    <i class="fa fa-edit"></i>
                                                                </button></a>

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc&proc_id=<?= $user['proc_id'] ?> "><button
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

                        <div class="tab-pane fade" id="nav-Teacher" role="tabpanel" aria-labelledby="nav-Teacher-tab">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Man's Product</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Avatar</th>
                                                    <th class="col-1">Name</th>
                                                    <th class="col-1">Price</th>
                                                    <th class="col-4">Hospital</th>
                                                    <th class="col-2">Categories</th>
                                                    <th class="col-1">Tags</th>
                                                    <th class="col-3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Start the Database to get the information of products -->
                                                <?php
                                                $stmt3 = $con->prepare("SELECT proc_id, proc_avatar,proc_name,price,cat_name,tag_name,host_name
                                                 From products, tags, category,hospital 
                                                 where products.cat_id = category.cat_id
                                                 and products.tag_id = tags.tag_id
                                                 and products.host_id = hospital.host_id
                                                 and tag_name = ( SELECT tag_name from tags where tag_name = 'men') ");
                                                 $stmt3->execute();
                                                $users =$stmt3->fetchAll();     
                                                if ($users > 0) {
                                                foreach ($users as $user) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="uploads/avatars/<?php echo $user['proc_avatar'] ?>"
                                                            alt=" NO AVATAR ">
                                                    </td>
                                                    <td>
                                                        <?php echo $user['proc_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['price']. 'RM' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['host_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['cat_name'] ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $user['tag_name'] ?>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group" role="group">

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                    type=" button"
                                                                    class="btn btn-outline-success d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button"
                                                                    class="btn btn-outline-success d-none d-lg-block confirm">Edit
                                                                    <i class="fa fa-edit"></i>
                                                                </button></a>

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc&proc_id=<?= $user['proc_id'] ?> "><button
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

                        <div class="tab-pane fade" id="nav-Student" role="tabpanel" aria-labelledby="nav-Student-tab">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Woman's Product</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Avatar</th>
                                                    <th class="col-1">Name</th>
                                                    <th class="col-1">Price</th>
                                                    <th class="col-4">Hospital</th>
                                                    <th class="col-2">Categories</th>
                                                    <th class="col-1">Tags</th>
                                                    <th class="col-3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Start the Database to get the information of products -->
                                                <?php
                                                $stmt3 = $con->prepare("SELECT proc_id, proc_avatar,proc_name,price,cat_name,tag_name,host_name
                                                 From products, tags, category,hospital 
                                                 where products.cat_id = category.cat_id
                                                 and products.tag_id = tags.tag_id
                                                 and products.host_id = hospital.host_id
                                                 and tag_name = ( SELECT tag_name from tags where tag_name = 'woman') ");
                                                 $stmt3->execute();
                                                $users =$stmt3->fetchAll();     
                                                if ($users > 0) {
                                                foreach ($users as $user) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="uploads/avatars/<?php echo $user['proc_avatar'] ?>"
                                                            alt=" NO AVATAR ">
                                                    </td>
                                                    <td>
                                                        <?php echo $user['proc_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['price']. 'RM' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['host_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['cat_name'] ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $user['tag_name'] ?>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group" role="group">

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=ban&user_id=<?= $user['user_id'] ?> "><button
                                                                    type=" button"
                                                                    class="btn btn-outline-success d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button"
                                                                    class="btn btn-outline-success d-none d-lg-block confirm">Edit
                                                                    <i class="fa fa-edit"></i>
                                                                </button></a>

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc&proc_id=<?= $user['proc_id'] ?> "><button
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

                        <div class="tab-pane fade" id="nav-Moderator" role="tabpanel"
                            aria-labelledby="nav-Moderator-tab">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Family's Product</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Avatar</th>
                                                    <th class="col-1">Name</th>
                                                    <th class="col-1">Price</th>
                                                    <th class="col-4">Hospital</th>
                                                    <th class="col-2">Categories</th>
                                                    <th class="col-1">Tags</th>
                                                    <th class="col-3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Start the Database to get the information of products -->
                                                <?php
                                                $stmt3 = $con->prepare("SELECT proc_id, proc_avatar,proc_name,price,cat_name,tag_name,host_name
                                                 From products, tags, category,hospital 
                                                 where products.cat_id = category.cat_id
                                                 and products.tag_id = tags.tag_id
                                                 and products.host_id = hospital.host_id
                                                 and tag_name = ( SELECT tag_name from tags where tag_name = 'family') ");
                                                 $stmt3->execute();
                                                $users =$stmt3->fetchAll();     
                                                if ($users > 0) {
                                                foreach ($users as $user) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="uploads/avatars/<?php echo $user['proc_avatar'] ?>"
                                                            alt=" NO AVATAR ">
                                                    </td>
                                                    <td>
                                                        <?php echo $user['proc_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['price']. 'RM' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['host_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['cat_name'] ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $user['tag_name'] ?>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group" role="group">

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc_Edit&proc_id=<?= $user['proc_id'] ?>"><button
                                                                    type=" button"
                                                                    class="btn btn-outline-success d-lg-none confirm"><i
                                                                        class="fa fa-ban"></i></button><button
                                                                    type="button"
                                                                    class="btn btn-outline-success d-none d-lg-block confirm">Edit
                                                                    <i class="fa fa-edit"></i>
                                                                </button></a>

                                                            <a onclick="return ban_confirmation('<?=$user['proc_name'];?>')"
                                                                href="important_user_controle.php?do=proc&proc_id=<?= $user['proc_id'] ?> "><button
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
}else{
    include 'sidebar.php' ;

include $tpl.'head_nav.php'; 
    echo '<div class="warrning  alert alert-danger">Sorry This page ONLY For Admins And Markting </div> ';
}
}else{
echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';

}?>
<!-- End the Main Page IF  -->
<?php include $tpl.'footer.php' ?>
