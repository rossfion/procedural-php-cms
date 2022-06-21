<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo WWW_ROOT . '/staff/index.php'; ?>">CMS Home</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">

                <?php if (is_logged_in()): ?>
                    <li>
                        <a href="<?php echo WWW_ROOT . ('/staff/pages'); ?>">Pages</a>
                    </li>

                    <li>
                        <a href="<?php echo WWW_ROOT . ('/staff'); ?>">Admin</a>
                    </li>

                    <li>
                        <a href="<?php echo WWW_ROOT . ('/posts'); ?>">Blog</a>
                    </li>

                    <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>


                <?php else: ?>

                    <li>
                        <a href="<?php echo WWW_ROOT . ('/posts'); ?>">Blog</a>
                    </li>


                    <li><a href="<?php echo url_for('/staff/login.php'); ?>">Login</a></li>


                <?php endif; ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>