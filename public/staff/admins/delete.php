<?php
require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $result = delete_admin($id);
    $_SESSION['message'] = "The admin was deleted successfully";
    redirect_to(url_for('/staff/admins/index.php'));
} else {
    $admin = find_admin_by_id($id);
}

$page_title = 'Delete Admin';
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
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Delete Admin</h2>
            <p>Are you sure you want to delete this admin?</p>
            <p class="item"><?php echo h($admin['username']); ?></p>

            <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
                <div class ="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-danger" type="submit" name="commit" value="Delete Admin">Delete Admin</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->  
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>
