<?php
require_once '../../../private/initialize.php';

require_login();

$id = $_GET['id'] ?? '1';

$page = find_page_by_id($id);

$page_title = 'PHP CMS | Show Page';
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
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back To List</a></button>
            <h2>Page: <?php echo h($page['menu_name']); ?></h2>

            <div class="panel panel-default">
                <div class="panel-heading">Page: <?php echo h($page['menu_name']); ?> | ID: <?php echo h($id); ?></div>
                <div class="panel-body">

                    <?php $subject = find_subject_by_id($page['subject_id']); ?>
                    <dl>
                        <dt>Subject</dt>
                        <dd><?php echo h($page['menu_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Menu Name</dt>
                        <dd><?php echo h($page['menu_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Position</dt>
                        <dd><?php echo h($page['position']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Visible</dt>
                        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
                    </dl>
                    <dl>
                        <dt>Content</dt>
                        <dd><?php echo h($page['content']); ?></dd>
                    </dl></div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>