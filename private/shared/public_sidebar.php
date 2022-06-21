<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form><!--search form-->
        <!-- /.input-group -->
    </div>

    <!--Login -->
    <div class="well">
        <?php if (isset($_SESSION['username'])): ?>

            <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>

            <a href="<?php echo url_for('/staff/logout.php'); ?>" class="btn btn-primary">Logout</a>

        <?php else: ?>

            <p>Do you already have an account?</p>
            <p>Click on the button to be taken to the login form</p>
            <a href="<?php echo url_for('/staff/login.php'); ?>" class="btn btn-primary">Login</a>

        <?php endif; ?>

    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $category_set = find_all_categories();
        ?>
        <h4>Blog Categories</h4>

        <div class="row">
            <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
                <div class="col-lg-12">

                    <ul class="list-unstyled">
                        <li>
                            <a href="/php_cms/public/posts/category.php?category=<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></a>
                        </li>

                    </ul>

                </div>
            <?php } ?>
        </div>
        <!-- /.row -->
    </div>
    <?php mysqli_free_result($category_set); ?>
    <!-- Side Widget Well -->
    <?php //include "widget.php"; ?>

</div>