<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validations
    if (is_blank($username)) {
        $errors[] = "Username cannot be blank.";
    }
    if (is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to login
    if (empty($errors)) {
        // Using one variable ensures that msg is the same
        $login_failure_msg = "Log in was unsuccessful.";

        $admin = find_admin_by_username($username);
        if ($admin) {

            if (password_verify($password, $admin['hashed_password'])) {
                // password matches
                log_in_admin($admin);
                redirect_to(url_for('/staff/index.php'));
            } else {
                // username found, but password does not match
                $errors[] = $login_failure_msg;
            }
        } else {
            // no username found
            $errors[] = $login_failure_msg;
        }
    }
}
?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-user fa-4x"></i></h3>
                            <h2 class="text-center">Login</h2>
                            <div class="panel-body">

                                <?php echo display_errors($errors); ?>

                                <form id="login-form" role="form" autocomplete="off" class="form" action="login.php" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                                            <input name="username" type="text" class="form-control" placeholder="Enter Username" value="<?php echo h($username); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input name="password" type="password" class="form-control" placeholder="Enter Password" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <input name="login" class="btn btn-lg btn-primary btn-block" value="Submit" type="submit">
                                    </div>


                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- /.container -->