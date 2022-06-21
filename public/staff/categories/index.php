<?php
require_once '../../../private/initialize.php';
require_login();

$page_title = 'PHP CMS | Categories';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php require SHARED_PATH . '/staff_top_navigation.php'; ?>
    <?php
    include SHARED_PATH . "/staff_sidebar.php";

    $category_set = find_all_categories();
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="actions">
                <a class="action" href="<?php echo url_for('/staff/categories/new.php'); ?>">Create New Category</a>
            </div>

            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
                    <tr>
                        <td><?php echo $category['cat_id']; ?></td>
                        <td><?php echo $category['cat_title']; ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/categories/show.php?id=' . h(u($category['cat_id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/categories/edit.php?id=' . h(u($category['cat_id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/categories/delete.php?id=' . h(u($category['cat_id']))); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            <?php mysqli_free_result($category_set); ?>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>