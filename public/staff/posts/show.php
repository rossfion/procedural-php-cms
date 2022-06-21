<?php
require_once '../../../private/initialize.php';

require_login();

$id = $_GET['id'] ?? '1';

$post = find_post_by_id($id);

$page_title = 'PHP CMS | Show Post';
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

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/posts/index.php'); ?>">&laquo; Back To List</a></button>

            <h2>Post: <?php echo h($post['post_title']); ?></h2>

            <div class="panel panel-default">
                <div class="panel-heading">Post: <?php echo h($post['post_title']); ?> | ID: <?php echo h($id); ?></div>
                <div class="panel-body">
                    <?php $category = find_category_by_id($post['post_category_id']); ?>
                    <dl>
                        <dt>Category</dt>
                        <dd><?php echo h($category['cat_title']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Post Title</dt>
                        <dd><?php echo h($post['post_title']); ?></dd>
                    </dl>

                    <dl>
                        <dt>Content</dt>
                        <dd><?php echo h($post['post_content']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Post Image</dt>
                        <dd><img width="100" src="/php_cms/public/images/<?php echo h($post['post_image']); ?>"></dd>
                    </dl>

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>