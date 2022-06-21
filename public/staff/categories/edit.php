<?php
require_once '../../../private/initialize.php';
require_login();

$page_title = 'PHP CMS | Edit Category';
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
        // Handle form values sent by new.php

        $category = [];
        $category['cat_id'] = $cat_id;
        $category['cat_title'] = $_POST['cat_title'] ?? '';

        $result = update_category($category);
        redirect_to(url_for('/staff/categories/show.php?id=' . $cat_id));
    } else {
        $category = find_category_by_id($cat_id);
    }
    $category_set = find_all_categories();
    $category_count = mysqli_num_rows($category_set);
    mysqli_free_result($category_set);
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

            <h2>Edit Category</h2>

            <form action="<?php echo url_for('/staff/categories/edit.php?id=' . h(u($cat_id))); ?>" method="post">
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="cat_title">Category Name</label>
                        <input type="text" name="cat_title" value="<?php echo h($category['cat_title']); ?>" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-primary"  type="submit" value="Edit Category" class="form-control">Edit Category</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>