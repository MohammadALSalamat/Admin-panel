<?php
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


                    <div class="dropdown for-Studentso">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="Students"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span class="count bg-danger"><?php echo countMemb('user_id', 'user') ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="Students">
                            <a class="dropdown-item media" href="<?= $loc . 'user_control'; ?>">
                                <p class="red">There is <?php echo countMemb('user_id', 'user') ?> users</p>
                            </a>
                        </div>
                    </div>


                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-tags"></i>
                            <span class="count bg-primary"><?= countMemb('cat_id', 'category') ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="message">
                            <a href="categories.php">
                                <p class="red">You have <?= countMemb('cat_id', 'category') ?> categories </p>
                            </a>
                        </div>
                    </div>



                    <div class="dropdown for-courses">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="courses"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i>
                            <span class="count bg-info"><?= countMemb('proc_id', 'products') ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="courses">
                            <a class="dropdown-item media" href="product.php">
                                <p class="red">There is <?= countMemb('proc_id', 'products') ?> Products</p>
                            </a>
                        </div>
                    </div>



                    <div class="dropdown for-Exams">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="Exams"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span class="count bg-dark"><?= $total_exams; ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="Exams">
                            <a class="dropdown-item media" href="<?= $loc . 'mocks'; ?>">
                                <p class="red">There is <?= $total_exams; ?> Payments</p>
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

                        <h5 class="nav-link"><i class="fa fa-user"></i><?= $user['user_Fname'] ?>
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

    </header><!-- /header -->
    <!-- Header-->


    <script type="text/javascript">
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table for USER.
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Topping');
        data1.addColumn('number', 'Slices');
        data1.addRows([
            ['Admin', 20],
            ['Moderator', 20],
            ['Teacher', 20],
            ['Student', 20]
        ]);

        // Set chart options USER
        var options1 = {
            'legend': 'left',
            'is3D': true,
            'width': 400,
            'height': 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_user'));
        chart1.draw(data1, options1);
    }
    </script>
    <div class="content mt-3">
        <div class="col-sm-12 col-lg-12 ">
            <!--Content-->
            <div class="row">
                <div class="col-sm-12 mb-4" style='width:100%;'>
                    <div class="card-group">
                        <div class="card col-md-6 no-padding ">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-users"></i>
                                </div>

                                <div class="h4 mb-0">
                                    <span class="count"><?php echo countMemb('User_id', 'user') ?></span>
                                </div>
                                <a href="#">
                                    <small class="text-muted text-uppercase font-weight-bold">Total
                                        Users</small></a>
                                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1"
                                    style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                        <div class="card col-md-6 no-padding ">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-tags"></i>
                                </div>
                                <div class="h4 mb-0">
                                    <span class="count"><?= countMemb('cat_id', 'category') ?></span>
                                </div><a href="categories.php">
                                    <small class="text-muted text-uppercase font-weight-bold">Total
                                        Categories</small></a>
                                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-2"
                                    style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>


                        <div class="card col-md-6 no-padding ">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                </div>
                                <div class="h4 mb-0">
                                    <span class="count"><?= countMemb('proc_id', 'products') ?> </span>
                                </div><a href="product.php">
                                    <small class="text-muted text-uppercase font-weight-bold">Total
                                        Products </small></a>
                                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-3"
                                    style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>


                        <div class="card col-md-6 no-padding ">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="h4 mb-0">
                                    <span class="count">15</span>
                                </div><a href="#">
                                    <small class="text-muted text-uppercase font-weight-bold">Total
                                        Payments</small></a>
                                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-4"
                                    style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Active users</h4>
                                <div class="flot-container">
                                    <div id="chart_user"></div>
                                </div>
                            </div>
                        </div><!-- /# card -->
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Total categories</h4>
                                <div class="flot-container">
                                    <div id="chart_category"></div>
                                </div>
                            </div>
                        </div><!-- /# card -->
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-6">
                        <div class="card">
                            <!-- /.panel Start-->
                            <div class="card-body">
                                <h4 class="mb-3">Earnings (last 6 months)</h4>
                                <div id="chart_earn"></div>
                            </div>
                        </div><!-- /.panel End-->
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <!-- /.panel Start-->
                            <div class="card-body">
                                <h4 class="mb-3"> Products </h4>
                                <div id="chart_exam"></div>
                            </div>
                        </div><!-- /.panel End-->
                    </div>
                </div>
            </div>
        </div><!-- /#page-wrapper -->

    </div>
    <?php } ?>
