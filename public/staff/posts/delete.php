<?php
require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/posts/index.php'));
}

$post_id = $_GET['id'];

// TODO an efficient unlink code for images

if (is_post_request()) {

    $result = delete_post($post_id);
    redirect_to(url_for('/staff/posts/index.php'));
} else {
    $post = find_post_by_id($post_id);
}

$page_title = 'Delete Post';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";
    ?>

    <!-- Content Wrapper. Contains post content -->
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

            <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/posts/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Delete Post</h2>
            <p>Are you sure you want to delete this post?</p>
            <p class="item"><?php echo h($post['post_title']); ?></p>

            <form action="<?php echo url_for('/staff/posts/delete.php?id=' . h(u($post['post_id']))); ?>" method="post">
                <div id="operations">
                    <button class = "btn btn-danger" type="submit" name="commit" value="Delete Post">Delete Post</button>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>


