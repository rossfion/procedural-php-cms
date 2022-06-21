<?php
require_once '../../../private/initialize.php';

require_login();

$id = $_GET['id'] ?? '1';

$admin = find_admin_by_id($id);

$page_title = 'PHP CMS | Show Admin';
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

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back To List</a></button>

            <h2>Admin: <?php echo h($admin['username']); ?></h2>

            <div class="panel panel-default">
                <div class="panel-heading">Admin: <?php echo h($admin['username']); ?> | ID: <?php echo h($id); ?> </div>
                <div class="panel-body">
                    <dl>
                        <dt>First Name</dt>
                        <dd><?php echo h($admin['first_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Last Name</dt>
                        <dd><?php echo h($admin['last_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Email</dt>
                        <dd><?php echo h($admin['email']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Username</dt>
                        <dd><?php echo h($admin['username']); ?></dd>
                    </dl>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>