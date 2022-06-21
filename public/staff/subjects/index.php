<?php
require_once '../../../private/initialize.php';

require_login();

$subject_set = find_all_subjects();

$page_title = 'PHP CMS | Subjects';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php require SHARED_PATH . '/staff_top_navigation.php'; ?>
    <?php include SHARED_PATH . "/staff_sidebar.php";
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Subjects
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

            <div class="actions">
                <a class="action" href="<?php echo url_for('/staff/subjects/new.php'); ?>">Create New Subject</a>
            </div>

            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

<?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>
                    <tr>
                        <td><?php echo $subject['id']; ?></td>
                        <td><?php echo $subject['position']; ?></td>
                        <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
                        <td><?php echo $subject['menu_name']; ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($subject['id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>">Delete</a></td>
                    </tr>
<?php } ?>
            </table>
                <?php mysqli_free_result($subject_set); ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div><!-- ./ -- wrapper-->