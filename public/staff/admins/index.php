<?php
require_once '../../../private/initialize.php';
require_login();

$page_title = 'PHP CMS | Admin Management';
require SHARED_PATH . '/staff_header.php';

$admin_set = find_all_admins();
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

            <h1>Admins</h1>

            <div class="actions">
                <button class="btn-btn-default"><a class="action" href="<?php echo url_for('/staff/admins/new.php'); ?>">Create New Admin</a></button>
            </div>

            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

<?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
                    <tr>
                        <td><?php echo h($admin['id']); ?></td>
                        <td><?php echo h($admin['first_name']); ?></td>
                        <td><?php echo h($admin['last_name']); ?></td>
                        <td><?php echo h($admin['email']); ?></td>
                        <td><?php echo h($admin['username']); ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
                    </tr>
            <?php } ?>
            </table>
<?php mysqli_free_result($admin_set); ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>