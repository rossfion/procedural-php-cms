<?php
require_once '../../../private/initialize.php';

require_login();

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

if (is_post_request()) {
    // Handle form values sent by new.php
    $subject = [];
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = insert_subject($subject);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = "The subject was added successfully";
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
    } else {
        // revisit section 8 on validation to complete
        $errors = $result;
    }
} else {
    // display the blank form
    $subject = [];
    $subject["menu_name"] = '';
    $subject["position"] = $subject_count;
    $subject["visible"] = '';
}
$page_title = 'PHP CMS | Create Subject';
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
    if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
    }
?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <button class="btn btn-default"> <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a></button>

            <h2>Create Subject</h2>
<?php echo display_errors($errors); ?>
            <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="menu_name">Menu Name</label>
                        <input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="position">Position</label>
                        <select name="position" class="form-control">
<?php
for ($i = 1; $i <= $subject_count; $i++) {
    echo "<option value=\"{$i}\"";
    if ($subject["position"] == $i) {
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
                        <input type="checkbox" name="visible" value="1" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-primary"  type="submit" value="Create Subject">Create Subject</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>