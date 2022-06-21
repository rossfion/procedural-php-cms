<?php
require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $result = delete_page($id);
    $_SESSION['message'] = "The subject was deleted successfully";
    redirect_to(url_for('/staff/pages/index.php'));
} else {
    $page = find_page_by_id($id);
}

$page_title = 'Delete Page';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                CMS STAFF AREA
                <small>Welcome, <?php //echo $_SESSION['username'];  ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Delete Page</h2>
            <p>Are you sure you want to delete this page?</p>
            <p class="item"><?php echo h($page['menu_name']); ?></p>

            <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
                <div id="operations">
                    <button class ="btn btn-danger" type="submit" name="commit" value="Delete Page">Delete Page</button>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>