<?php
require_once '../../../private/initialize.php';

require_login();
$page_title = 'PHP CMS | Create Category';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";

    if (is_post_request()) {
        // Handle form values sent by new.php
        $category = [];
        $category['cat_title'] = $_POST['cat_title'] ?? '';

        $result = insert_category($category);
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/categories/show.php?id=' . $new_id));
    } else {
        // revisit section 8 on validation to complete
        $errors = $result;
    }
    $category_set = find_all_categories();
    $category_count = mysqli_num_rows($category_set) + 1;
    mysqli_free_result($category_set);

    $category = [];
    $category['position'] = $category_count;
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

            <a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a>

            <h1>Create Category</h1>

            <form action="<?php echo url_for('/staff/categories/new.php'); ?>" method="post">
                <dl>
                    <dt>Category Name</dt>
                    <dd><input type="text" name="cat_title" value="" /></dd>
                </dl>

                <div id="operations">
                    <input type="submit" value="Create Category" />
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>
