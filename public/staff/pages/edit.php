<?php
require_once '../../../private/initialize.php';

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    // Handle form values sent by new.php

    $page = [];
    $page['id'] = $id;
	$page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
	$page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
	if($result === true){
		$_SESSION['message'] = "The subject was updated successfully";
		redirect_to(url_for('/staff/pages/show.php?id=' . $id));
	} else {
		$errors = $result;
	}
    
} else {
    $page = find_page_by_id($id);
}

	$page_set = find_all_pages();
	$page_count = mysqli_num_rows($page_set);
	mysqli_free_result($page_set);


$page_title = 'PHP CMS | Edit Page';
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
                <small>Welcome, <?php echo $_SESSION['username']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

           <button class="btn btn-default"> <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Edit Page</h2>

            <?php echo display_errors($errors); ?>

            <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
			<div class="form-group">
        <div class="col-md-10">
        <label for="subject_id">Subject</label>
          <select name="subject_id" class="form-control">
          <?php
            $subject_set = find_all_subjects();
            while($subject = mysqli_fetch_assoc($subject_set)) {
              echo "<option value=\"" . h($subject['id']) . "\"";
              if($page["subject_id"] == $subject['id']) {
                echo " selected";
              }
              echo ">" . h($subject['menu_name']) . "</option>";
            }
            mysqli_free_result($subject_set);
          ?>
          </select>
        </div>
      </div>
                <div class="form-group">
        <div class="col-md-10">
        <label for="menu_name">Menu Name</label>
                    <input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" class="form-control" />
                </div>
				</div>
                <div class="form-group">
        <div class="col-md-10">
        <label for="position">Position</label>
                        <select name="position" <?php echo h($position); ?> class="form-control" />
                            <?php
              for($i=1; $i <= $page_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($page["position"] == $i) {
                  echo " selected";
                }
                echo ">{$i}</option>";
              }
            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
        <div class="col-md-10">
        <label for="visible">Visible</label>
                        <input type="hidden" name="visible" value="0" />
                        <input type="checkbox" name="visible" value="1"<?php
                        if ($page['visible'] == "1") {
                            echo " checked";
                        }
                        ?> />
                    </div>
                </div>
				<div class="form-group">
        <div class="col-md-10">
        <label for="content">Content</label>
          <textarea class="form-control" name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
        </div>
		</div>
                <div class="form-group">
        <div class="col-md-10">
                    <button class="btn btn-primary" type="submit" value="Edit Page">Edit Page</button>
                </div>
				</div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>

