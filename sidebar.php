<?php 
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
$userID = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid'])?intval($_SESSION['Aid']):0;
$stmt2 = $con->prepare(" SELECT role_name 
                        FROM user u, postion p 
                        WHERE u.role_id=p.role_id 
                        and p.role_id = (SELECT user.role_id 
                                         from user 
                                         where user_id = '$userID' ) ");
$stmt2->execute();
$views =$stmt2->fetchAll();
if ($views > 0) {
foreach ($views as $view){}
}
            
?>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand">
                <img src="healtopedia-logo.png" max-width="200px" width="100%">
            </a>
            <a class="navbar-brand hidden" href="#"><i class="menu-icon fa fa-home"></i></a>

        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="dashboard.php"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">Users</h3>
                <!-- /.menu-title -->
                <!-- 
                    Here the top name of the menu......
                  -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon ti-user"> </i> User
                        Control</a>
                    <!-- 
                    Here the list of the menu......
                  -->
                    <ul class="sub-menu children dropdown-menu">

                        <li><i class="menu-icon fa fa-users"></i><a
                                href="controlle.php?do=<?= $view['role_name']?>&user_id=<?= $userID ?>"
                                class=" <?=($class==11)?"current":'';?>">View Users</a></li>
                        <li><i class="menu-icon fa fa-user"></i><a
                                href="view_ban_users.php?do=<?= $view['role_name'] ?>"
                                class="<?=($class==13)?"current":'';?>">Banned Users</a></li>

                    </ul>
                </li>
                <h3 class="menu-title">Products</h3>
                <!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-book"></i> Product
                        Control</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-book"></i><a href="product.php"
                                class="<?=($class==91)?"current":'';?>">View Product</a></li>
                        <li><i class="menu-icon fa fa-book"></i><a href="important_user_controle.php?do=Add&&user_id=<?= $userID ?>"
                                class="<?=($class==92)?"current":'';?>">Create Product</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Categories</h3>
                <!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-code-fork"></i>
                        Categories</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-code-fork"></i><a href="categories.php"
                                class="<?=($class==61)?"current":'';?>">View </a></li>
                        <li><i class="menu-icon fa fa-code-fork"></i><a href="important_user_controle.php?do=catAdd&user_id=<?= $userID ?>"
                                class="<?=($class==62)?"current":'';?>">Create </a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-code-fork"></i>
                        Orders</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-code-fork"></i><a
                                href="<?=$loc.'admin_control/view_subcategories';?>"
                                class="<?=($class==63)?"current":'';?>">View orders </a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Blog</h3>
                <!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-comment"></i> Blog
                        Control</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-comment"></i><a href="<?=$loc.'blog/view_all';?>"
                                class="<?=($class==71)?"current":'';?>">View Posts</a></li>
                        <li><i class="menu-icon fa fa-comment"></i><a href="<?=$loc.'blog/add';?>"
                                class="<?=($class==72)?"current":'';?>">Add Post</a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Admin Area</h3>
                <!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i> Admin Area
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-cogs"></i><a href="profile_info.php"
                                class="<?=($class==31)?"current":'';?>">Profile Settings</a></li>
                        <li><i class="menu-icon fa fa-cogs"></i><a
                                href="<?=$loc.'admin/system_control/view_settings';?>"
                                class="<?=($class==32)?"current":'';?>">System </a></li>
                        <li><i class="menu-icon fa fa-cogs"></i><a href="<?=$loc.'noticeboard'; ?>"
                                class="<?=($class==34)?"current":'';?>"> Noticeboard</a></li>
                        <li><i class="menu-icon fa fa-cogs"></i><a href="<?=$loc.'message_control'; ?>"
                                class="<?=($class==36)?"current":'';?>"> Inbox</a></li>
                        <li><i class="menu-icon fa fa-cogs"></i><a
                                href="<?=$loc.'admin_control/view_payment_history'; ?>"
                                class="<?=($class==35)?"current":'';?>"> Payment </a></li>
                        <li><i class="menu-icon fa fa-cogs"></i><a href="<?=$loc.'faq_control';?>"
                                class="<?=($class==33)?"current":'';?>">FAQ</a></li>

                    </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

</aside>
<!-- /#left-panel -->

<!-- Left Panel -->
<?php }else{
echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';

}?>
