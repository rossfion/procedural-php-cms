<?php
require_once '../../../private/initialize.php';

require_login();

$page_title = 'PHP CMS | Edit Subject';
require SHARED_PATH . '/staff_header.php';
?>
<div class="wrapper">
    <?php
    require SHARED_PATH . '/staff_top_navigation.php';
    include SHARED_PATH . "/staff_sidebar.php";

    if (!isset($_GET['id'])) {
        redirect_to(url_for('/staff/subjects/index.php'));
    }

    $id = $_GET['id'];

    if (is_post_request()) {
        // Handle form values sent by new.php

        $subject = [];
        $subject['id'] = $id;
        $subject['menu_name'] = $_POST['menu_name'] ?? '';
        $subject['position'] = $_POST['position'] ?? '';
        $subject['visible'] = $_POST['visible'] ?? '';

        $result = update_subject($subject);

        if ($result === true) {
            $_SESSION['message'] = "The subject was updated successfully";
            redirect_to(url_for('/users/subjects/show.php?id=' . $id));
        } else {
            $errors = $result;
        }
    }
    $subject = find_subject_by_id($id);

    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);
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

            <h2>Edit Subject</h2>
<?php echo display_errors($errors); ?>
            <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="menu_name">Menu Name</label>
                        <input class="form-control" type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <label for="position">Position</label>
                        <select name="position" class="form-control">
                            <?php
                            for ($i = 1; $i <= $subject_count; $i++) {
                                echo "<option value=\"{id}\"";
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
                        <input type="checkbox" name="visible" value="1"<?php
                               if ($subject['visible'] == "1") {
                                   echo " checked";
                               }
                               ?> />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button class="btn btn-primary" type="submit" value="Edit Subject" />Edit Subject</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require SHARED_PATH . '/staff_footer.php'; ?>
</div>