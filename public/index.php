<?php
require_once '../private/initialize.php';
/*
 * CMS built with procedural PHP and MySQLi.
 *
 * Based on the courses of two Udemy instructors, Edwin Diaz and Dave Hollingworth, and LinkedIn instructor Kevin Skoglund.
 *
 * This is a mashup which seeks to demonstrate my implementation of procedural PHP and MySQLi.
 *
 * This project does NOT include Diaz's special 
 * features sections, nor does it include the section
 * on nested resources from Skoglund's course.
 * 
 * Fionn Ross, completed June 2022
 * https://fionnrossonline.com
 */

$preview = false;
if (isset($_GET['preview'])) {
    // previewing should require admin to be logged in
    $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

 if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id, ['visible' => true]);
    if (!$page) {
        redirect_to(url_for('/index.php'));
    }
    $subject_id = $page['subject_id'];
    $subject = find_subject_by_id($subject_id, ['visible' => true]);
	//var_dump($subject);
    if (!$subject) {
        redirect_to(url_for('/index.php'));
    }
} elseif(isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $subject = find_subject_by_id($subject_id, ['visible' => true]);
    if (!$subject) {
        redirect_to(url_for('/index.php'));
    }
    $page_set = find_pages_by_subject_id($subject_id, ['visible' => true]);
    $page = mysqli_fetch_assoc($page_set); // first page
    mysqli_free_result($page_set);
    if (!$page) {
        redirect_to(url_for('/index.php'));
    }
    $page_id = $page['id'];
} else {
    // nothing selected; show the homepage
} 


$page_title = 'PHP CMS | Procedural PHP CMS';
require SHARED_PATH . '/public_header.php';

require SHARED_PATH . '/public_top_navigation.php';
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">

            <div id="main">
                <?php require SHARED_PATH . '/public_side_navigation.php'; ?>

                <div id="page">
                    <?php
                    if (isset($page)) {
                        // show the page from the database
                        // TODO add strip tags with allowed tags ch.3
                        echo h($page['content']);
                    } else {
                        //Show the homepage
                        require SHARED_PATH . '/static_homepage.php';
                    }
                    ?>
                </div>

            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php //include SHARED_PATH . "/public_sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php require SHARED_PATH . '/public_footer.php'; ?>