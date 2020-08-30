<?php
session_start();
$pageTitle = 'User Controller'; // title of the page get by function

include 'init.php'; // this is what we made in init.php to get the url of template
if (isset($_SESSION['Email']) && isset($_SESSION['pass']) && isset($_SESSION['Aid'])) {
    $userIDuser = isset($_SESSION['Aid']) && is_numeric($_SESSION['Aid']) ? intval($_SESSION['Aid']) : 0;
    $stmt2 = $con->prepare("SELECT * From user,postion
                        where Status > 0
                        and user.role_id = postion.role_id
                        and user_id =$userIDuser
                        order by postion.role_id Desc");
    $stmt2->execute();
    $views = $stmt2->fetchAll();
    if ($views > 0) {
        foreach ($views as $view) {
        }
    }

    $do = '';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'Delete';
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe DELETE PAGE For Users   /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($do == 'Delete') { // Start the Delete page
        echo '<h1 class="text-center"> Delete Member </h1> ';
        echo '<div class="container"> ';

        $userID = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;

        // chech all information of the user based on suer_id
        $check = checkUsers('user_id', 'user', $userID);
        if ($check > 0) {
            //prepare the data to delete it
            $stmt = $con->prepare(" DELETE from user where user_id = :zuser");
            $stmt->bindParam(":zuser", $userID); // associate the prametars
            $stmt->execute();
            $theMsg = '<div class="success alert alert-success"> ' . $stmt->rowCount() . ' Recourd Deleted </div>';
            handleError($theMsg, 'important_user_controle.php');
        } //End Delete page

        // if there is error in data above then show this message
        else {
            echo '<div class="container">';
            $theMsg = '<div class=" warrning  alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'important_user_controle.php'); // function handler
            echo '</div>';
        }

        echo '</div> ';
    } // End The Delete Page
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe DELETE PAGE For products   /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($do == 'proc') { // Start the Delete page
        echo '<h1 class="text-center"> Delete product </h1> ';
        echo '<div class="container"> ';

        $procID = isset($_GET['proc_id']) && is_numeric($_GET['proc_id']) ? intval($_GET['proc_id']) : 0;
        // chech all information of the user based on suer_id
        $check = checkUsers('proc_id', 'products', $procID);
        if ($check > 0) {
            //prepare the data to delete it
            $stmt = $con->prepare(" DELETE from products where proc_id = :zuser");
            $stmt->bindParam(":zuser", $procID); // associate the prametars
            $stmt->execute();
            $theMsg = '<div class="success alert alert-success"> ' . $stmt->rowCount() . ' Recourd Deleted </div>';
            handleError($theMsg, 'important_user_controle.php');
        } //End Delete page

        // if there is error in data above then show this message
        else {
            echo '<div class="container">';
            $theMsg = '<div class="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'important_user_controle.php'); // function handler
            echo '</div>';
        }

        echo '</div> ';
    } // End The Delete Page

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe DELETE PAGE For Category   /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($do == 'catDelet') { // Start the Delete page
        echo '<h1 class="text-center"> Delete Category </h1> ';
        echo '<div class="container"> ';

        $catId = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
        // chech all information of the user based on suer_id
        $check = checkUsers('cat_id', 'category', $catId);
        if ($check > 0) {
            //prepare the data to delete it
            $stmt = $con->prepare(" DELETE from category where cat_id = :Zcat_id");
            $stmt->bindParam(":Zcat_id", $catId); // associate the prametars
            $stmt->execute();
            $theMsg = '<div class = "success alert alert-success"> ' . $stmt->rowCount() . ' Recourd Deleted </div>';
            handleError($theMsg, 'categories.php');
        } //End Delete page

        // if there is error in data above then show this message
        else {
            echo '<div class="container">';
            $theMsg = '<div class="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'categories.php'); // function handler
            echo '</div>';
        }

        echo '</div> ';
    } // End The Delete Page
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe BAN PAGE   /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($do == 'ban') { //start the ban page
        echo '<h1 class="text-center"> Ban Member </h1> ';
        echo '<div class="container"> ';

        $userID = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        // chech all information of the user based on suer_id
        $check = checkUsers('user_id', 'user', $userID);
        if ($check > 0) {
            //prepare the data to delete it
            $stmt = $con->prepare(" UPDATE user Set Status = 0 where user_id=:zuser");
            $stmt->bindParam(":zuser", $userID); // associate the prametars
            $stmt->execute();
            $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . ' The user Is banned now </div>';
            handleError($theMsg, 'view_ban_users.php');
        } //End Delete page

        // if there is error in data above then show this message
        else {
            echo '<div class="container">';
            $theMsg = '<div class="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, "view_ban_users.php"); // function handler
            echo '</div>';
        }

        echo '</div> ';
    } //End  the ban page

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Active For ban users ///////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($do == 'Active') { //start the active ban users page
        echo '<h1 class="text-center"> Active Member </h1> ';
        echo '<div class="container"> ';

        $userID = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        // chech all information of the user based on suer_id
        $check = checkUsers('user_id', 'user', $userID);
        if ($check > 0) {
            //prepare the data to delete it
            $stmt = $con->prepare(" UPDATE user Set Status = 1 where user_id=:zuser");
            $stmt->bindParam(":zuser", $userID); // associate the prametars
            $stmt->execute();
            $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . ' The user Is banned now </div>';
            handleError($theMsg, 'dashboard.php');
        } //End Delete page

        // if there is error in data above then show this message
        else {
            echo '<div class="container">';
            $theMsg = '<div class="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'dashboard.php'); // function handler
            echo '</div>';
        }

        echo '</div> ';
    } //End  the active ban users page

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Add PAGE  For products  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($do == 'Add') {
        if ($view['role_id'] != 1) { ?>

<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Add</strong> Products
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=Insert' method='POST' enctype="multipart/form-data">
                <input type="hidden" name='proc_id' value="<?php echo $procID ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Name :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Name of the product" name='name' class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Description :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Description for the product" name='description'
                            class="form-control" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Price :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Price Of the product" name='price' class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Hospital :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="host" class="form-control">
                            <option value="0">
                                <-- Select The Hospital -->
                            </option>
                            <?php
                                        $stmt2 = $con->prepare(" SELECT * from hospital");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach ($cats as $cat) {
                                            echo '<option value="' . $cat['host_id'] . '">' . $cat['host_name'] . '</option>';
                                        }
                                        ?>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Categories :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="category" class="form-control">
                            <option value="0">
                                <-- Select The Category -->
                            </option>
                            <?php
                                        $stmt2 = $con->prepare(" SELECT * from Category");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach ($cats as $cat) {
                                            echo '<option value="' . $cat['cat_id'] . '">' . $cat['cat_name'] . '</option>';
                                        }
                                        ?>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Tags :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="tag" class="form-control">
                            <option value="0">
                                <-- Select The Tags -->
                            </option>
                            <?php
                                        $stmt = $con->prepare("SELECT * from tags");
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user) {
                                            echo '<option value="' . $user['tag_id'] . '">' . $user['tag_name'] . '</option>';
                                        }
                                        ?>
                        </select>

                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Avatar:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" name='avatar' class="form-control" required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;

                </div>
            </form>

        </div>
    </div>
</div>

<?php
        } else {
            include 'sidebar.php';

            include $tpl . 'head_nav.php';
            echo '<div class="warrning  alert alert-danger">Sorry This page ONLY For Admins And Markting Team </div> ';
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe insert PAGE  For products  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    elseif ($do == 'Insert') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Add New Product </h1> ';
            echo '<div class="container"> ';

            //Uplode Image // and its parts // very important part

            $avatar = $_FILES['avatar'];
            $avaterName = $avatar['name'];
            $avaterSize = $avatar['size'];
            $avaterTmp = $avatar['tmp_name'];
            $avaterType = $avatar['type'];
            // type of files that allow to uplode
            $avaterAllowExtension = array("jpeg", "jpg", "png", "gif");
            // Get the avatar extension if its allow then ok otherwise No Uplode
            $avaterAllowExtension = explode('.', $avaterName);
            $avaterExtension = strtolower(end($avaterAllowExtension));

            /*
            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $name = $_POST['name']; // get the date from Edit page
            $description = $_POST['description']; // get the date from Edit page
            $price = $_POST['price']; // get the date from Edit page
            $host = $_POST['host'];
            $cat = $_POST['category'];
            $tag = $_POST['tag'];

            // Start validate The form

            $FormArrayErr = array();

            if (empty($name)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  name is required </div>';
            }

            if (empty($description)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> description is required </div>';
            }
            if (!empty($avaterName) && !in_array($avaterExtension, $avaterAllowExtension)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> This Extension is Not allowed  </div>';
            }

            if (empty($avaterSize) > 4194304) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> Avatar Can not be More Than 4 MB  </div>';
            }
            if (empty($price)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> price is required </div>';
            }

            if ($tag == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the tag </div>';
            }

            if ($cat == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the category </div>';
            }

            if ($host == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the Hospital-name </div>';
            }
            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form

            // if there is no error then do the update
            if (empty($FormArrayErr)) {
                $avatar = rand(1, 1000000) . '_' . $avaterName;
                move_uploaded_file($avaterTmp, 'uploads\avatars\\' . $avatar);
                // query to Insert the values
                $stmt = $con->prepare("INSERT into products
                (cat_id ,tag_id,host_id,proc_name,proc_description,proc_avatar,price,add_date) VALUES(:Zcat,:Ztag,:Zhost,:Zname,:Zdescr,:Zavatar,:Zprice,now())"); // this link we type : for securty

                $stmt->execute(array(
                    ':Zcat' => $cat, // values defined above
                    ':Ztag' => $tag, // values defined above
                    ':Zhost' => $host, // values defined above
                    ':Zname' => $name, // values defined above
                    ':Zdescr' => $description, // values defined above
                    ':Zavatar' => $avatar, // values defined above
                    ':Zprice' => $price, // values defined above
                )); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message
                $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . '  Recourd Inserted </div>';
                handleError($theMsg, "product.php"); // function handler
                echo '</div>';
            } // End check exist user in database
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class ="warrning alert-danger"> Sorry you can not enter this page directly </div>';
            handleError($theMsg, '"product.php"'); // function handler
            echo '</div>';
        }

        echo '</div>'; // end of continer
    } //End of Insert page

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Edit PAGE  For products  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    elseif ($do == 'proc_Edit') {

        // in htis row we create an error message to handle wrong input of user_id and it MUST be Number
        $procID = isset($_GET['proc_id']) && is_numeric($_GET['proc_id']) ? intval($_GET['proc_id']) : 0;
        // chech all information of the user based on suer_id

        $stmt = $con->prepare(
            "SELECT *
        FROM products
        WHERE proc_id = ? "
        ); // prepare the data base to be shown
        // print the data
        $stmt->execute(array($procID));
        $row = $stmt->fetch(); // bring the data from database
        $count = $stmt->rowCount(); // check the there is any data at least 1 row
        if ($count > 0) {
            ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Modify</strong> Products
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=Update' method='POST' enctype="multipart/form-data">
                <input type="hidden" name='proc_id' value="<?php echo $procID ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Name :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Name of the product" name='name' class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Description :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Description for the product" name='description'
                            class="form-control" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Product Price :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Price Of the product" name='price' class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Hospital :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="host" class="form-control">
                            <option value="0">
                                <-- Select The Hospital -->
                            </option>
                            <?php
                                        $stmt2 = $con->prepare(" SELECT * from hospital");
            $stmt2->execute();
            $cats = $stmt2->fetchAll();
            foreach ($cats as $cat) {
                echo '<option value="' . $cat['host_id'] . '"';
                if ($row['host_id'] == $cat['host_id']) {
                    echo 'selected';
                }
                echo '>' . $cat['host_name'] . '</option>';
            } ?>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Categories :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="category" class="form-control">
                            <option value="0">
                                <-- Select The Category -->
                            </option>
                            <?php
                                        $stmt2 = $con->prepare(" SELECT * from Category");
            $stmt2->execute();
            $cats = $stmt2->fetchAll();
            foreach ($cats as $cat) {
                echo '<option value="' . $cat['cat_id'] . '"';
                if ($row['cat_id'] == $cat['cat_id']) {
                    echo 'selected';
                }
                echo '>' . $cat['cat_name'] . '</option>';
            } ?>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Tags :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="tag" class="form-control">
                            <option value="0">
                                <-- Select The Tags -->
                            </option>
                            <?php
                                        $stmt = $con->prepare("SELECT * from tags");
            $stmt->execute();
            $users = $stmt->fetchAll();
            foreach ($users as $user) {
                echo '<option value="' . $user['tag_id'] . '"';
                if ($row['tag_id'] == $user['tag_id']) {
                    echo 'selected';
                }
                echo '>' . $user['tag_name'] . '</option>';
            } ?>
                        </select>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;

                </div>
            </form>

        </div>
    </div>
</div>

<?php
        }
        // if there is error in data above then show this message
        else {
            echo '<div class = "container">';
            $errorMsg = " Sorry There is no such ID ";
            handleError($errorMsg); // function handler
            echo '</div>';
        }
    } //end ELSEIF OF Edit page
    elseif ($do == 'Update') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Edit Member </h1> ';
            echo '<div class="container"> ';

            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $id = $_POST['proc_id']; // get the date from Edit page
            $name = $_POST['name']; // get the date from Edit page
            $description = $_POST['description']; // get the date from Edit page
            $price = $_POST['price']; // get the date from Edit page
            $host = $_POST['host'];
            $cat = $_POST['category'];
            $tag = $_POST['tag'];

            $FormArrayErr = array();

            if (empty($name)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  name is required </div>';
            }

            if (empty($description)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> description is required </div>';
            }

            if (empty($price)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> price is required </div>';
            }

            if ($host == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the status </div>';
            }

            if ($cat == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the category </div>';
            }

            if ($tag == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the member-name </div>';
            }
            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form
            if (empty($FormArrayErr)) {
                // query to upade the values
                $stmt = $con->prepare("UPDATE products SET
                               cat_id = ?,
                               tag_id =?,
                               host_id= ?,
                               proc_name = ?,
                               proc_description = ?,

                               price = ?
                               WHERE proc_id = ? ");
                $stmt->execute(array($cat, $tag, $host, $name, $description, $price, $id)); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message

                $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . '  Recourd Updated </div>';
                handleError($theMsg, 'product.php?do=proc_Edit');
            } // end of the check the error
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class ="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'product.php');
            echo '</div>';
        }

        echo '</div> '; // end of continer
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Modify PAGE  For user Profile  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    elseif ($do == 'modifyUser') {

        // in htis row we create an error message to handle wrong input of user_id and it MUST be Number
        $userIDuser1 = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        // chech all information of the user based on suer_id

        $stmt = $con->prepare(
            "SELECT *
        FROM user u, postion p
        WHERE u.role_id=p.role_id
        and user_id =$userIDuser1 "
        ); // prepare the data base to be shown
        // print the data
        $stmt->execute();
        $row = $stmt->fetch(); // bring the data from database
        $count = $stmt->rowCount(); // check the there is any data at least 1 row
        if ($count > 0) {
            ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Modify</strong> user
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=UsermodUser' method='POST'
                enctype="multipart/form-data">
                <input type="hidden" name='userIDuser' value="<?php echo $userIDuser1 ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* First Name :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="First Name" name="Fname1" class="form-control"
                            required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Last Name:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Last Name" name="Lname1" class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Email:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="email" placeholder="Email" name="Email1" class="form-control" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone :</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="phone1" class="form-control"
                            pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" title="Enter Valid Phone Number" min="8"
                            max="15" placeholder="Phone Number" required="required">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;

                </div>
            </form>

        </div>
    </div>
</div>
<?php
        }
    } elseif ($do == 'UsermodUser') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Edit Member </h1> ';
            echo '<div class="container"> ';

            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $id = $_POST['userIDuser1']; // get the date from Edit page
            $Fname = $_POST['Fname1']; // get the date from Edit page
            $Lname = $_POST['Lname1']; // get the date from Edit page
            $phone = $_POST['phone1']; // get the date from Edit page
            $Email = $_POST['Email1'];

            $FormArrayErr = array();

            if (empty($Fname)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  Fname is required </div>';
            }

            if (empty($Lname)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> Lname is required  </div>';
            }

            if (empty($phone)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> phone is required </div>';
            }

            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form
            if (empty($FormArrayErr)) {
                // query to upade the values
                $stmt = $con->prepare("UPDATE user SET
                               user_Fname = ?,
                               user_Lname =?,
                               Email= ?,
                               Phone = ?
                               WHERE user_id = ? ");
                $stmt->execute(array($Fname, $Lname, $Email, $phone, $id)); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message

                $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . '  Recourd Updated </div>';
                handleError($theMsg, 'product.php?do=modify');
            } // end of the check the error
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class ="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'product.php');
            echo '</div>';
        }

        echo '</div> '; // end of continer
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Modify PAGE  For Users  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    elseif ($do == 'modify') {

        // in htis row we create an error message to handle wrong input of user_id and it MUST be Number
        $userID = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        // chech all information of the user based on suer_id

        $stmt = $con->prepare(
            "SELECT *
        FROM user u, postion p
        WHERE u.role_id=p.role_id
        and user_id =$userID "
        ); // prepare the data base to be shown
        // print the data
        $stmt->execute();
        $row = $stmt->fetch(); // bring the data from database
        $count = $stmt->rowCount(); // check the there is any data at least 1 row
        if ($count > 0) {
            ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Modify</strong> user
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=Usermod' method='POST' enctype="multipart/form-data">
                <input type="hidden" name='userID' value="<?php echo $row['user_id'] ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* First Name :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="First Name" name="Fname" class="form-control"
                            required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Last Name:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Last Name" name="Lname" class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Email:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="email" placeholder="Email" name="Email" class="form-control" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone :</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="phone" class="form-control"
                            pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" title="Enter Valid Phone Number" min="8"
                            max="15" placeholder="Phone Number" required="required">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Role :</label></div>
                    <div class="col-12 col-md-9">
                        <select name="user_role" class="form-control">
                            <option value="0">
                                <-- Select The Role -->
                            </option>
                            <?php
                                        $stmt = $con->prepare("SELECT * from postion ");
            $stmt->execute();
            $users = $stmt->fetchAll();
            foreach ($users as $user) {
                echo '<option value="' . $user['role_id'] . '"';
                if ($row['role_id'] == $user['role_id']) {
                    echo 'selected';
                }
                echo '>' . $user['role_name'] . '</option>';
            } ?>
                        </select>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;

                </div>
            </form>

        </div>
    </div>
</div>
<?php
        }
    } elseif ($do == 'Usermod') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Edit Member </h1> ';
            echo '<div class="container"> ';

            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $id = $_POST['userID']; // get the date from Edit page
            $Fname = $_POST['Fname']; // get the date from Edit page
            $Lname = $_POST['Lname']; // get the date from Edit page
            $phone = $_POST['phone']; // get the date from Edit page
            $Email = $_POST['Email'];
            $role = $_POST['user_role'];

            $FormArrayErr = array();

            if (empty($Fname)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  Fname is required </div>';
            }

            if (empty($Lname)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> Lname is required  </div>';
            }

            if (empty($phone)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> phone is required </div>';
            }

            if ($role == 0) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> You have to choose the Role for the user </div>';
            }

            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form
            if (empty($FormArrayErr)) {
                // query to upade the values
                $stmt = $con->prepare("UPDATE user SET
                               user_Fname = ?,
                               user_Lname =?,
                               Email= ?,
                               Phone = ?,
                               Role_id = ?
                               WHERE user_id = ? ");
                $stmt->execute(array($Fname, $Lname, $Email, $phone, $role, $id)); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message

                $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . '  Recourd Updated </div>';
                handleError($theMsg, 'product.php?do=modify');
            } // end of the check the error
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class ="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'product.php');
            echo '</div>';
        }

        echo '</div> '; // end of continer
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////  Start THe Edit  PAGE  For Category  ///////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    elseif ($do == 'catEdit') {

        // in htis row we create an error message to handle wrong input of user_id and it MUST be Number
        $catId = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
        // chech all information of the user based on suer_id

        $stmt = $con->prepare(
            "SELECT *
        FROM category
        WHERE cat_id = ? "
        ); // prepare the data base to be shown
        // print the data
        $stmt->execute(array($catId));
        $row = $stmt->fetch(); // bring the data from database
        $count = $stmt->rowCount(); // check the there is any data at least 1 row
        if ($count > 0) {
            ?>
<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Modify</strong> Categories
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=catupdate' method='POST'
                enctype="multipart/form-data">
                <input type="hidden" name='catId' value="<?php echo $catId ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Categories :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="cat_name" class="form-control">
                            <option value="0">
                                <-- Select The Category -->
                            </option>
                            <?php
                                        $stmt2 = $con->prepare(" SELECT * from Category");
            $stmt2->execute();
            $cats = $stmt2->fetchAll();
            foreach ($cats as $cat) {
                echo '<option value="' . $cat['cat_name'] . '"';
                if ($row['cat_name'] == $cat['cat_name']) {
                    echo 'selected';
                }
                echo '>' . $cat['cat_name'] . '</option>';
            } ?>
                        </select>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Description :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Description for the category" name='desc' class="form-control"
                            required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;

                </div>
            </form>

        </div>
    </div>
</div>
<?php
        } else {
            echo '<div class = "container">';
            $errorMsg = " Sorry There is no such ID ";
            handleError($errorMsg); // function handler
            echo '</div>';
        }
        // if there is error in data above then show this message
    } elseif ($do == 'catupdate') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Edit Category </h1> ';
            echo '<div class="container"> ';

            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $id = $_POST['catId']; // get the date from Edit page
            $catName = $_POST['cat_name']; // get the date from Edit page
            $Desc = $_POST['desc']; // get the date from Edit page

            $FormArrayErr = array();

            if (empty($catName)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  category name is required </div>';
            }

            if (empty($Desc)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> Description is required  </div>';
            }

            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form
            if (empty($FormArrayErr)) {
                // query to upade the values
                $stmt = $con->prepare("UPDATE category SET
                               cat_name =?,
                               description= ?
                               WHERE cat_id = ? ");
                $stmt->execute(array($catName, $Desc, $id)); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message

                $theMsg = '<div class = "success alert alert-success"> ' . $stmt->rowCount() . '  Recourd Updated </div>';
                handleError($theMsg, 'categories.php?do=catEdit');
            } // end of the check the error
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class ="warrning alert-danger"> Sorry you can not Enter this page directly </div>';
            handleError($theMsg, 'categories.php?do=catEdit');
            echo '</div>';
        }

        echo '</div> '; // end of continer
    } elseif ($do == 'catAdd') {
        if ($view['role_id'] != 1) { ?>

<?php include 'sidebar.php' ?>
<!-- Start the right content Table -->
<?php include $tpl . 'head_nav.php' ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> Add </strong> Categories
        </div>
        <div class="card-body card-block">

            <form role="form" class="form-horizontal" action='?do=catInsert' method='POST'
                enctype="multipart/form-data">
                <input type="hidden" name='catId' value="<?php echo $catId ?>">


                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Category Name :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Add Name for the category" name='name' class="form-control"
                            required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">* Description :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" placeholder="Description for the category" name='desc' class="form-control"
                            required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">* Avatar:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" name='avatar' class="form-control" required="required">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Required :</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="text-muted">* Required fields.</p>

                    </div>
                </div>


                <div class="col-12" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;


                </div>
            </form>

        </div>
    </div>
</div>

<?php
        } else {
            include 'sidebar.php';

            include $tpl . 'head_nav.php';
            echo '<div class="warrning  alert alert-danger">Sorry This page ONLY For Admins And Markting Team </div> ';
        }
    } elseif ($do == 'catInsert') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the user enter the page using mehtod or direct

            echo '<h1 class="text-center"> Add New Category </h1> ';
            echo '<div class="container"> ';

            //Uplode Image // and its parts // very important part

            $avatar = $_FILES['avatar'];
            $avaterName = $avatar['name'];
            $avaterSize = $avatar['size'];
            $avaterTmp = $avatar['tmp_name'];
            $avaterType = $avatar['type'];
            // type of files that allow to uplode
            $avaterAllowExtension = array("jpeg", "jpg", "png", "gif");
            // Get the avatar extension if its allow then ok otherwise No Uplode
            $avaterAllowExtension = explode('.', $avaterName);
            $avaterExtension = strtolower(end($avaterAllowExtension));

            /*
            /*
            once the user enter by using mehtod then
            prepare the values that come from the Edit page
            to be ready in the update page
             */
            $name = $_POST['name']; // get the date from Edit page
            $description = $_POST['desc']; // get the date from Edit page

            // Start validate The form

            $FormArrayErr = array();

            if (empty($name)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger">  name is required </div>';
            }

            if (empty($description)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> description is required </div>';
            }
            if (!empty($avaterName) && !in_array($avaterExtension, $avaterAllowExtension)) {
                $FormArrayErr[] = '<div class ="warrning alert-danger"> This Extension is Not allowed  </div>';
            }

            if (empty($avaterSize) > 4194304) {
                $FormArrayErr[] = '<div class =" warrning alert-danger"> Avatar Can not be More Than 4 MB  </div>';
            }

            //looop into the errors and print all
            foreach ($FormArrayErr as $error) {
                echo $error . '</br>';
            }
            // End validate The form

            // if there is no error then do the update
            if (empty($FormArrayErr)) {
                $avatar = rand(1, 1000000) . '_' . $avaterName;
                move_uploaded_file($avaterTmp, 'uploads\avatars\\' . $avatar);
                // query to Insert the values
                $stmt = $con->prepare("INSERT into category
                (cat_name,description,avater) VALUES(:Zname,:Zdescr,:Zavatar)"); // this link we type : for securty

                $stmt->execute(array(
                    ':Zname' => $name, // values defined above
                    ':Zdescr' => $description, // values defined above
                    ':Zavatar' => $avatar, // values defined above
                )); // execute the values using the array because it accept 1 parameter only
                // if all detalis are correct then echo this message
                $theMsg = '<div class = "success alert alert-success">  ' . $stmt->rowCount() . '  Recourd Inserted </div>';
                handleError($theMsg, "categories.php"); // function handler
                echo '</div>';
            } // End check exist user in database
        } //end of check of the server
        else {
            echo '<div class = "container">';
            $theMsg = '<div class =" warrning  alert-danger"> Sorry you can not enter this page directly </div>';
            handleError($theMsg, '"categories.php"'); // function handler
            echo '</div>';
        }

        echo '</div>'; // end of continer
    } //End of Insert page
} else {
    echo '<div class="warrning alert alert-danger"> Sorry you Can Not Enter This Page Directly , So PLease  <a href = "index.php" > <b>Login From Here</b></a> </div> ';
} //End of Session

?>
<?php include $tpl . 'footer.php' ?>
