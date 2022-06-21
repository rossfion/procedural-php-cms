<?php
require_once '../../../private/initialize.php';
require_login();
$page_title = 'PHP CMS | Show Category';

require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";

    $id = $_GET['id'] ?? '1';

    $category = find_category_by_id($id);
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

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back To List</a></button>

            <h2>Category: <?php echo h($category['cat_title']); ?></h2>

            <div class="panel panel-default">
                <div class="panel-heading">Category: <?php echo h($category['cat_title']); ?> | ID: <?php echo h($id); ?></div>
                <div class="panel-body">
                    <div class="attributes">
                        <dl>
                            <dt>Category Name</dt>
                            <dd><?php echo h($category['cat_title']); ?></dd>
                        </dl>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>