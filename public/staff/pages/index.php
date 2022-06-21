<?php
require_once '../../../private/initialize.php';

require_login();

$page_title = 'PHP CMS | Pages';
require SHARED_PATH . '/staff_header.php';

$page_set = find_all_pages();
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
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <h1>Pages</h1>

            <div class="actions">
                <a class="action" href="<?php echo url_for('/staff/pages/new.php'); ?>">Create New Page</a>
            </div>

            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Page Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
                    <?php $subject = find_subject_by_id($page['subject_id']); ?>
                    <tr>
                        <td><?php echo h($page['id']); ?></td>
                        <td><?php echo h($subject['menu_name']); ?></td>
                        <td><?php echo h($page['position']); ?></td>
                        <td><?php echo h($page['visible']) == 1 ? 'true' : 'false'; ?></td>
                        <td><?php echo h($page['menu_name']); ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            <?php mysqli_free_result($page_set); ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>