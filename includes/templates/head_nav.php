 <?php 
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
    $userID = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid'])?intval($_SESSION['Aid']):0;
    $stam = $con->prepare("SELECT * 
                            from user
                            where user_id = ?
                            ");
    $stam->execute(array($userID));
    $users = $stam->fetchAll();
    foreach( $users as $user ){

    }

?>
 
 
 <div id="right-panel" class="right-panel">

     <!-- Header-->
     <header id="header" class="header">

         <div class="header-menu">

             <div class="col-sm-7">
                 <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                 <div class="header-left">
                     <button class="search-trigger"><i class="fa fa-search"></i></button>
                     <div class="form-inline">
                         <form class="search-form">
                             <input class="form-control mr-sm-2" type="text" placeholder="Search ...(soon)"
                                 aria-label="Search">
                             <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                         </form>
                     </div>


                     <div class="dropdown for-Students">
                         <button class="btn btn-secondary dropdown-toggle" type="button" id="Students"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-users"></i>
                             <span class="count bg-danger"><?php echo countMemb('user_id' ,'user') ?></span>
                         </button>
                         <div class="dropdown-menu" aria-labelledby="Students">
                             <a class="dropdown-item media" href="<?= $loc.'user_control'; ?>">
                                 <p class="red">There is <?php echo countMemb('user_id' ,'user') ?> users</p>
                             </a>
                         </div>
                     </div>


                     <div class="dropdown for-message">
                         <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-tags"></i>
                             <span class="count bg-primary"><?= countMemb('cat_id' ,'category') ?></span>
                         </button>
                         <div class="dropdown-menu" aria-labelledby="message">
                             <a href="categories.php">
                                 <p class="red">You have <?= countMemb('proc_id' ,'products') ?> Categories </p>
                             </a>
                         </div>
                     </div>



                     <div class="dropdown for-courses">
                         <button class="btn btn-secondary dropdown-toggle" type="button" id="courses"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-product-hunt"></i>
                             <span class="count bg-info"> <?= countMemb('proc_id' ,'products') ?> </span>
                         </button>
                         <div class="dropdown-menu" aria-labelledby="courses">
                             <a class="dropdown-item media" href="product.php">
                                 <p class="red">There is <?= countMemb('proc_id' ,'products') ?> Products</p>
                             </a>
                         </div>
                     </div>



                     <div class="dropdown for-Exams">
                         <button class="btn btn-secondary dropdown-toggle" type="button" id="Exams"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-bullseye"></i>
                             <span class="count bg-dark"><?= $total_exams; ?></span>
                         </button>
                         <div class="dropdown-menu" aria-labelledby="Exams">
                             <a class="dropdown-item media" href="<?= $loc.'mocks'; ?>">
                                 <p class="red">There is <?= $total_exams; ?> Exams</p>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-5">
                 <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">
                         <i class="fa fa-user fa-2x"></i>
                     </a>

                     <div class="user-menu dropdown-menu" style="margin: 0 ; padding:0;">

                         <h5 class="nav-link"><i class="fa fa-user"></i> <?= $user['user_Fname'] ?>
                         </h5>

                         <a class="nav-link" href="profile_info.php"><i class="fa fa-cogs"></i> My
                             Profile</a>

                         <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>
                             Logout</a>
                     </div>
                 </div>

                 <div class="language-select dropdown" id="language-select">
                     <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true"
                         aria-expanded="true">
                         EN
                     </a>
                     <div class="dropdown-menu" aria-labelledby="language">
                         <div class="dropdown-item">
                             soon
                         </div>
                     </div>
                 </div>
             </div>
             <!-- End the top navbar-->
         </div>
     </header>
<?php   }

?>