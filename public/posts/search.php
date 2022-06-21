<?php
require_once '../../private/initialize.php';

$page_title = 'PHP CMS | Search Results';
require SHARED_PATH . '/public_header.php';
require SHARED_PATH . '/public_top_navigation.php';

if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    $search_set = find_search_results($search);
    if (!$search_set) {
        die("QUERY FAILED" . mysqli_error($db));
    }
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">
                <?php
                $count = mysqli_num_rows($search_set);

                if ($count == 0) {

                    echo "<h1> Your search query did not find anything...</h1>";
                } else {
                    ?>
                    <?php while ($post = mysqli_fetch_array($search_set)) { ?>
                        <h1 class="page-header">
                            Search Results
                            <small>here are your search results...</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post['post_title'] ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post['post_author'] ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date'] ?></p>
                        <hr>
                        <img class="img-responsive" src="/php_cms/public/images/<?php echo $post['post_image']; ?>" alt="">
                        <hr>
                        <p><?php echo $post['post_content'] ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                    <?php }
                }
            } ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
<?php include SHARED_PATH . "/public_sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

<?php require SHARED_PATH . '/public_footer.php'; ?>