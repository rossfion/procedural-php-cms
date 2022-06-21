<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/php_cms/public/stylesheets/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>CMS ADMIN</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-book"></i> <span>Manage Posts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/posts/index.php'); ?>">View All Posts</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Manage Subjects</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/subjects/index.php'); ?>">View All Subjects</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Manage Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/pages/index.php'); ?>">View All Pages</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Manage Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/categories/index.php'); ?>">View All Categories</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Manage Comments</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/comments/index.php'); ?>">View All Comments</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>Manage Admins</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">View All Admins</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user-circle"></i> <span>Your Profile</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>