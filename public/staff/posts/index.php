<?php
require_once '../../../private/initialize.php';

require_login();

$page_title = 'PHP CMS | Posts';
require SHARED_PATH . '/staff_header.php';

$article_set = find_all_posts();
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

            <h1>Posts</h1>

            <div class="actions">
                <a class="action" href="<?php echo url_for('/staff/posts/new.php'); ?>">Create New Post</a>
            </div>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php while ($post = mysqli_fetch_assoc($article_set)) { ?>
                    <?php $category = find_category_by_id($post['post_category_id']); ?>
                    <tr>
                        <td><?php echo h($post['post_id']); ?></td>
                        <td><?php echo h($category['cat_title']); ?></td>
                        <td><?php echo h($post['post_title']); ?></td>
                        <td><?php echo h($post['post_author']); ?></td>
                        <td><?php echo h($post['post_user']); ?></td>
                        <td><?php echo h($post['post_date']); ?></td>

                        <td><img width="100" src="/php_cms/public/images/<?php echo h($post['post_image']); ?>"</td>
                        <td><?php echo h($post['post_tags']); ?></td>
                        <td><?php echo h($post['post_comment_count']); ?></td>
                        <td><?php echo h($post['post_status']); ?></td>
                        <td><?php echo h($post['post_views_count']); ?></td>

                        <td><a class="action" href="<?php echo url_for('/staff/posts/show.php?id=' . h(u($post['post_id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/posts/edit.php?id=' . h(u($post['post_id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/posts/delete.php?id=' . h(u($post['post_id']))); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            <?php mysqli_free_result($article_set); ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>