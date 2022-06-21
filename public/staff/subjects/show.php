<?php
require_once '../../../private/initialize.php';

require_login();

 ?>
<div class="wrapper">
<?php 
$page_title = 'PHP CMS | Show Subject'; 
require SHARED_PATH.'/staff_header.php';
require SHARED_PATH.'/staff_top_navigation.php';
include SHARED_PATH."/staff_sidebar.php"; 

$id = $_GET['id'] ?? '1';

$subject = find_subject_by_id($id);

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

      <button class="btn btn-default"><a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back To List</a></button>
								
				
				<h2>Subject: <?php echo h($subject['menu_name']); ?></h2>
				
				<div class="panel panel-default">
  <div class="panel-heading">Subject: <?php echo h($subject['menu_name']); ?> | ID: <?php echo h($id); ?></div>
  <div class="panel-body">
  
  <dl>
    <dt>Menu Name</dt>
    <dd><?php echo h($subject['menu_name']); ?></dd>
  </dl>
  <dl>
    <dt>Position</dt>
    <dd><?php echo h($subject['position']); ?></dd>
  </dl>
  <dl>
    <dt>Visible</dt>
    <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
  </dl>
  </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require SHARED_PATH.'/staff_footer.php'; ?>
</div><!--./wrapper-->
