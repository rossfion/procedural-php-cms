<?php
require_once('../../../private/initialize.php');
require_login();
$page_title = 'Delete Category';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";

    if (!isset($_GET['id'])) {
        redirect_to(url_for('/staff/categories/index.php'));
    }
    $cat_id = $_GET['id'];

    if (is_post_request()) {
        $result = delete_category($cat_id);
        redirect_to(url_for('/staff/categories/index.php'));
    } else {
        $category = find_category_by_id($cat_id);
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
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

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Delete Category</h2>
            <p>Are you sure you want to delete this category?</p>
            <p class="item"><?php echo h($category['cat_title']); ?></p>

            <form action="<?php echo url_for('/staff/categories/delete.php?id=' . h(u($category['cat_id']))); ?>" method="post">
                <div id="operations">
                    <button class="btn btn-danger"  type="submit" name="commit" value="Delete Category">Delete Category</button>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>