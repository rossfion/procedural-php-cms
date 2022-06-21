<?php
/*
 * CMS built with procedural PHP and MySQLi
 * Taken from the courses of two Udemy instructors, Edwin Diaz and Dave Hollingworth, and LinkedIn instructor Kevin Skoglund
 * This is a mashup which seeks to demonstrate my implementation of procedural PHP and MySQLi
 * @ Fionn Ross, completed June 2022
 */
require_once '../.././private/initialize.php';

require_login();

$page_title = 'PHP CMS | Staff Menu';
require SHARED_PATH . '/staff_header.php';
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
                <small>Welcome, <?php 
		if(isset($_SESSION['username'])) {
			echo $_SESSION['username'];
			}?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
            | Your Page Content Here |
            -------------------------->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div><!-- ./ wrapper -->