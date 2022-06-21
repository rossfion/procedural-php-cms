<?php
require_once '../../private/initialize.php';

if (isset($_GET['category'])) {
    $id = $_GET['category'];
    $posts = find_posts_by_category_id($id);
}

$page_title = 'PHP CMS | Show Posts by Category';
require SHARED_PATH . '/public_header.php';
require SHARED_PATH . '/public_top_navigation.php';
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">
            <?php
            $count = mysqli_num_rows($posts);

            if ($count == 0) {

                echo "<h1> There are no posts in this category - yet...</h1>";
            } else {
                ?>
                <?php while ($post = mysqli_fetch_assoc($posts)) { ?>
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

                <?php }
            } ?>

        </div><!-- ./ col-md-8 -->

        <!-- Blog Sidebar Widgets Column -->

<?php include SHARED_PATH . "/public_sidebar.php"; ?>

    </div>
    <!-- /.row -->

<?php require SHARED_PATH . '/public_footer.php'; ?>