<?php
require_once '../../../private/initialize.php';
require_login();

$page_title = 'PHP CMS | Comments';
require SHARED_PATH . '/staff_header.php';
$comment_set = find_all_comments();
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
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <form action="" method='post'>

                <table class="table table-bordered table-hover">

                    <div id="bulkOptionContainer" class="col-xs-4">

                        <select class="form-control" name="bulk_options" id="">
                            <option value="">Select Options</option>
                            <option value="approved">Approve</option>
                            <option value="unapproved">Unapprove</option>
                            <option value="delete">Delete</option>
                        </select>

                    </div> 


                    <div class="col-xs-4">

                        <input type="submit" name="submit" class="btn btn-success" value="Apply">

                    </div>

                    <thead>
                        <tr>
                            <th><input id="selectAllBoxes" type="checkbox"></th>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>


                        <?php while ($comment = mysqli_fetch_assoc($comment_set)) { ?>
                            <tr>
                                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment['comment_id']; ?>'></td>
                                <td><?php echo $comment['comment_id']; ?></td>

                                <td><?php echo $comment['comment_author']; ?></td>
                                <td><?php echo $comment['comment_content']; ?></td>
                                <td><?php echo $comment['comment_email']; ?></td>
                                <td><?php echo $comment['comment_status']; ?></td>
                                <td><?php echo $comment['comment_post_id']; ?></td>
                                <td><?php echo $comment['comment_date']; ?></td>
                                <td><a class="action" href="<?php echo url_for('/staff/comments/approve_comment.php?id=' . h(u($comment['comment_id']))); ?>">Approve</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/comments/unapprove_comment.php?id=' . h(u($comment['comment_id']))); ?>">Unapprove</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/comments/delete_comment.php?id=' . h(u($comment['comment_id']))); ?>">Delete</a></td>
                            </tr>

                        <?php } ?>


                    </tbody>
                </table>

            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php require SHARED_PATH . '/staff_footer.php'; ?>
</div><!-- ./ -- wrapper -->