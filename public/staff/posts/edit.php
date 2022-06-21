<?php
require_once '../../../private/initialize.php';

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/posts/index.php'));
}

$post_id = $_GET['id'];

if (is_post_request()) {
    // Handle form values sent by new.php

    $post = [];
    $post['post_id'] = $post_id;
    $post['post_category_id'] = $_POST['post_category_id'] ?? '';
    $post['post_title'] = $_POST['post_title'] ?? '';
    $post['post_author'] = $_POST['post_author'] ?? '';
    $post['post_user'] = $_POST['post_user'] ?? '';
    $post['post_date'] = date($_POST['post_date']) ?? '';

    // TODO improve this image update code
    $post['post_image'] = $_FILES['post_image']['name'] ?? '';
    $post_image_temp = $_FILES['post_image']['tmp_name'] ?? '';

    //$post['post_image'] = $_POST['post_image'] ?? '';
    $post['post_content'] = $_POST['post_content'] ?? '';
    $post['post_tags'] = $_POST['post_tags'] ?? '';
    $post['post_status'] = $_POST['post_status'] ?? '';

    $post_image = $post['post_image'];

    move_uploaded_file($post_image_temp, "../../images/$post_image");

    $result = update_post($post);
    redirect_to(url_for('/staff/posts/show.php?id=' . $post_id));
} else {
    $post = find_post_by_id($post_id);

    $article_set = find_all_posts();
    $article_count = mysqli_num_rows($article_set);
    mysqli_free_result($article_set);
}

$page_title = 'PHP CMS | Edit Post';
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

            <h2>Edit Page</h2>

            <form action="<?php echo url_for('/staff/posts/edit.php?id=' . h(u($post_id))); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_category_id">Post Category</label>

                        <select name="post_category_id" class="form-control">
                            <?php
                            $category_set = find_all_categories();
                            while ($category = mysqli_fetch_assoc($category_set)) {
                                echo "<option value=\"" . h($category['cat_id']) . "\"";
                                if ($post["post_category_id"] == $category['cat_id']) {
                                    echo " selected";
                                }
                                echo ">" . h($category['cat_title']) . "</option>";
                            }
                            mysqli_free_result($category_set);
                            ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_title">Post Title</label>
                        <input name="post_title" id="post_title" placeholder="Article title" value="<?php echo h($post['post_title']); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_author">Post Author</label>
                        <input type="text" class="form-control" name="post_author" value="<?php echo h($post['post_author']); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_user">Post User</label>
                        <input type="text" class="form-control" name="post_user" value="<?php echo h($post['post_user']); ?>">
                    </div>
                </div>

                <div class="col-md-10 input-group date" data-provide="datepicker">
                    <label for="post_date">Publication date and time</label>
                    <input class="form-control" type="text" name="post_date" id="post_date" value="<?php echo h($post['post_date']); ?>">

                    <div class="input-group-add-on">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_image">Post Image</label>
                        <input type="file"  name="post_image" value="<?php echo h($post['post_image']); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_content">Post Content</label>
                        <textarea class="form-control" name="post_content" rows="4" cols="40" id="post_content" placeholder="Article content"><?php echo h($post['post_content']); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_tags">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags" value="<?php echo h($post['post_tags']); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="post_status">Post Status&nbsp;</label>
                        <select name="post_status" id="" value="<?php echo h($post['post_status']); ?>">
                            <option value="">Please select...</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-primary"  type="submit" value="Edit Post">Edit Post</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->  
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>