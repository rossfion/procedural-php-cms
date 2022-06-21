<?php

// subjects start here
function find_all_subjects($options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM subjects ";
    if ($visible) {
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    // echo $sql; 
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}

function validate_subject($subject) {
    $errors = [];

    // menu_name
    if (is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

function insert_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
    $sql .= ")";
//echo $sql;
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
    $sql .= "WHERE id ='" . db_escape($db, $subject['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id) {
    global $db;

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// TODO shift position code
// pages start here
function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_page_by_id($id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;
}

function validate_page($page) {
    $errors = [];

    // subject_id
    if (is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if (is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $page['id'] ?? '0';
    if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors[] = "Menu name must be unique.";
    }


    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    // content
    if (is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
    }

    return $errors;
}

function insert_page($page) {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $page['position']) . "',";
    $sql .= "'" . db_escape($db, $page['visible']) . "',";
    $sql .= "'" . db_escape($db, $page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_page($page) {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";
    $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $page['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
    $sql .= "content='" . db_escape($db, $page['content']) . "' ";
    $sql .= "WHERE id ='" . db_escape($db, $page['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_page($id) {
    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_pages_by_subject_id($subject_id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id ='" . db_escape($db, $subject_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// TODO page count code
// TODO shift position code
// categories start here

function find_all_categories() {
    global $db;

    $sql = "SELECT * FROM categories";
    //$sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_category_by_id($cat_id) {
    global $db;
    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE cat_id = '" . db_escape($db, $cat_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category;
}

function insert_category($category) {
    global $db;

    $sql = "INSERT INTO categories ";
    $sql .= "(cat_title) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $category['cat_title']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_category($category) {
    global $db;

    $sql = "UPDATE categories SET ";
    $sql .= "cat_title='" . db_escape($db, $category['cat_title']) . "' ";
    $sql .= "WHERE cat_id ='" . db_escape($db, $category['cat_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_category($cat_id) {
    global $db;

    $sql = "DELETE FROM categories ";
    $sql .= "WHERE cat_id = '" . db_escape($db, $cat_id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// posts start here
function find_all_posts() {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "ORDER BY post_date DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_post_by_id($id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE post_id = '" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $post;
}

function insert_post($post) {
    global $db;

    $sql = "INSERT INTO posts ";
    $sql .= "(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $post['post_category_id']) . "',";
    $sql .= "'" . db_escape($db, $post['post_title']) . "',";
    $sql .= "'" . db_escape($db, $post['post_author']) . "',";
    $sql .= "'" . db_escape($db, $post['post_user']) . "',";
    $sql .= "'" . db_escape($db, $post['post_date']) . "',";
    $sql .= "'" . db_escape($db, $post['post_image']) . "',";
    $sql .= "'" . db_escape($db, $post['post_content']) . "',";
    $sql .= "'" . db_escape($db, $post['post_tags']) . "',";
    $sql .= "'" . db_escape($db, $post['post_status']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_post($post) {
    global $db;

    $sql = "UPDATE posts SET ";
    $sql .= "post_category_id='" . db_escape($db, $post['post_category_id']) . "', ";
    $sql .= "post_title='" . db_escape($db, $post['post_title']) . "', ";
    $sql .= "post_author='" . db_escape($db, $post['post_author']) . "', ";
    $sql .= "post_user='" . db_escape($db, $post['post_user']) . "', ";
    $sql .= "post_date='" . db_escape($db, $post['post_date']) . "', ";
    $sql .= "post_image='" . db_escape($db, $post['post_image']) . "', ";
    $sql .= "post_content='" . db_escape($db, $post['post_content']) . "', ";
    $sql .= "post_tags='" . db_escape($db, $post['post_tags']) . "', ";
    $sql .= "post_status='" . db_escape($db, $post['post_status']) . "' ";
    $sql .= "WHERE post_id ='" . db_escape($db, $post['post_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_post($id) {
    global $db;

    $sql = "DELETE FROM posts ";
    $sql .= "WHERE post_id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_posts_by_category_id($post_category_id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE post_category_id = '" . db_escape($db, $post_category_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    $sql .= "ORDER BY post_date DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_search_results($search) {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE post_tags LIKE '" . db_escape($db, $search) . "' ";

    $sql .= "ORDER BY post_date DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// comments start here

function find_all_comments() {
    global $db;

    $sql = "SELECT * FROM comments ";
    $sql .= "ORDER BY comment_date DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_comment_by_id($id, $options = []) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM comments ";
    $sql .= "WHERE comment_id = '" . db_escape($db, $id) . "' ";
    if ($visible) {
        // make this a TINYINT(2) if not already
        $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $comment = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $comment;
}

function insert_comment($comment) {
    global $db;

    $sql = "INSERT INTO comments ";
    $sql .= "(comment_post_id, comment_author, comment_content, comment_email, comment_status) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $comment['comment_post_id']) . "',";
    $sql .= "'" . db_escape($db, $comment['comment_author']) . "',";
    $sql .= "'" . db_escape($db, $comment['comment_content']) . "',";
    $sql .= "'" . db_escape($db, $comment['comment_email']) . "',";
    $sql .= "'" . db_escape($db, $comment['comment_status']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function approve_comment($id) {
    global $db;
    $sql = "UPDATE comments SET comment_status = 'approved' ";
    $sql .= "WHERE comment_id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function unapprove_comment($id) {
    global $db;
    $sql = "UPDATE comments SET comment_status = 'unapproved' ";
    $sql .= "WHERE comment_id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_comment($id) {
    global $db;

    $sql = "DELETE FROM comments ";
    $sql .= "WHERE comment_id = '" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_comments_by_post_id($id, $options = []) {
    global $db;

    $comment_status = $options['comment_status'] ?? false;
    $sql = "SELECT * FROM comments ";
    $sql .= "WHERE comment_post_id = '" . db_escape($db, $id) . "' ";
    //TODO
    if ($comment_status) {
        $sql .= "AND comment_status = true";
    }
    $sql .= "ORDER BY comment_date DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// admins CRUD goes here
function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;
}

function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username = '" . db_escape($db, $username) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;
}

function validate_admin($admin, $options = []) {

    $password_required = $options['password_required'] ?? true;

    if (is_blank($admin['first_name'])) {
        $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($admin['last_name'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($admin['email'])) {
        $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
        $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
        $errors[] = "Email must be a valid format.";
    }

    if (is_blank($admin['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
        $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }

    if ($password_required) {
        if (is_blank($admin['password'])) {
            $errors[] = "Password cannot be blank.";
        } elseif (!has_length($admin['password'], array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
        } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }

        if (is_blank($admin['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($admin['password'] !== $admin['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }

    return $errors;
}

function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required', $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";

    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if ($password_sent) {
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";

    $sql .= "WHERE id ='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_admin($id) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
