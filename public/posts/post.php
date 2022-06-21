<?php
require_once '../../private/initialize.php';

$id = $_GET['id'] ?? '1';

if (is_post_request()) {

    $comment = [];
    $comment['comment_post_id'] = $id;
    $comment['comment_author'] = $_POST['comment_author'] ?? '';
    $comment['comment_email'] = $_POST['comment_email'] ?? '';
    $comment['comment_content'] = $_POST['comment_content'] ?? '';
    $comment['comment_status'] = $_POST['comment_status'] ?? '';

    $result = insert_comment($comment);
} else {
    $comment = [];
    $comment['comment_post_id'] = $id;
    $comment['comment_author'] = '';
    $comment['comment_email'] = '';
    $comment['comment_content'] = '';
    $comment['comment_status'] = '';
    $comment['comment_date'] = '';

    $comment_set = find_all_comments();
    $comment_count = mysqli_num_rows($comment_set) + 1;
    mysqli_free_result($comment_set);
}

$post = find_post_by_id($id);

$page_title = 'PHP CMS | Show Post';
require SHARED_PATH . '/public_header.php';
require SHARED_PATH . '/public_top_navigation.php';
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">

            <article>
                <!-- p_id = query parameter-->
                <h2><a href="post.php?id=<?= $post['post_id']; ?>"><?= $post['post_title']; ?></a></h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post['post_author']; ?>&p_id=<?php echo $post['post_id']; ?>"><?php echo $post['post_author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date']; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post['post_id']; ?>">
                    <!-- TODO sort out this image path -->
                    <img class="img-responsive" src="/php_cms/public/images/<?php echo $post['post_image']; ?>" alt="">
                </a>
                <hr>
                <p><?= $post['post_content']; ?></p>

            </article>
            <hr>

            <!-- Comments Form -->
            <div class="well">

                <h4>Leave a Comment:</h4>
                <form action="#" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Author">Email</label>
                        <input type="email" name="comment_email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>
            <?php
            $comments = find_comments_by_post_id($id);
            ?>
            <!-- Comment -->
            <div class="media">
                <?php while ($comment = mysqli_fetch_array($comments)) { ?>
                    <a class="pull-left" href="#">
                        <img class="media-object" src="/php_cms/public/images/default_image.jpg" width="100" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment['comment_author']; ?>
                            <small><?php echo $comment['comment_date']; ?></small>
                        </h4>

                        <?php echo $comment['comment_content']; ?>

                    </div>

                <?php } ?>
            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include SHARED_PATH . "/public_sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

    <?php require SHARED_PATH . '/public_footer.php'; ?>