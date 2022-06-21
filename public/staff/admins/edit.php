<?php
require_once '../../../private/initialize.php';

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    // Handle form values sent by new.php

    $admin = [];
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

    $result = update_admin($admin);
    if ($result === true) {
        $_SESSION['message'] = "The admin was updated successfully";
        redirect_to(url_for('/staff/admins/show.php?id=' . $id));
    } else {
        $errors = $result;
    }
} else {
    $admin = find_admin_by_id($id);

    $admin_set = find_all_admins();
    $admin_count = mysqli_num_rows($admin_set);
    mysqli_free_result($admin_set);
}

$page_title = 'PHP CMS | Edit Admin';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";
    ?>
    <!-- Content Wrapper. Contains admin content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                CMS STAFF AREA
                <small>Welcome, <?php
    if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
    }
    ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Edit Admin</h2>
            <?php echo display_errors($errors); ?>
            <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" class="form-control" />
                    </div>
                </div>

                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" class="form-control" />
                    </div>
                </div>

                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo h($admin['email']); ?>" class="form-control" />
                    </div>
                </div>
                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo h($admin['username']); ?>" class="form-control" />
                    </div>
                </div>
                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo h($admin['password']); ?>" class="form-control" />
                    </div>
                </div>
                <div class ="form-group">
                    <div class="col-md-10">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" value="<?php echo h($admin['confirm_password']); ?>" class="form-control" />
                        <p>
                            Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
                        </p>
                    </div>

                </div>


                <div class ="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-primary" type="submit" value="Edit Admin">Edit Admin</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->  
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>