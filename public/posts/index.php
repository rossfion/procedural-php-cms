<?php
require_once '../../private/initialize.php';

$page_title = 'PHP CMS | Blog';
require SHARED_PATH . '/public_header.php';

require SHARED_PATH . '/public_top_navigation.php';

$article_set = find_all_posts();
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">


            <?php if (empty($article_set)): ?>
                <p>No posts found.</p>
            <?php else: ?>

                <?php while ($post = mysqli_fetch_array($article_set)) { ?>
                    <article>
                        <h2><a href="post.php?id=<?= $post['post_id']; ?>"><?= $post['post_title']; ?></a></h2>
                        <p class="lead">
                            by <a href="author_posts.php?author=<?php echo $post['post_author']; ?>&p_id=<?php echo $post['id']; ?>"><?php echo $post['post_author']; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date']; ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post['id']; ?>">
                            <!-- TODO sort out this image path -->
                            <img class="img-responsive" src="/php_cms/public/images/<?php echo $post['post_image']; ?>" alt="">
                        </a>
                        <hr>
                        <p><?= $post['post_content']; ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post['id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </article>
                <?php } ?>

            <?php endif; ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include SHARED_PATH . "/public_sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>
    <?php require SHARED_PATH . '/public_footer.php'; ?>