<?php
$page_title = "register";
include 'includes/header.php';
include 'includes/db_connect.php';
include 'errors.php';
$errors = array();
if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $second_name = mysqli_real_escape_string($conn, $_POST['second_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $user_type = $_POST['user_type'];
    //var_dump( $user_type);
    if (!preg_match("/^[a-zA-Z ]+$/", $first_name)) {
        $error = true;
        array_push($errors, "First name is required must contain only alphabets and space");
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $second_name)) {
        $error = true;
        array_push($errors, "Second name is required must contain only alphabets and space");
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $last_name)) {
        $error = true;
        array_push($errors, "Last name is required must contain only alphabets and space");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        array_push($errors, "Valid email is required");
    }
    if (strlen($password) < 6) {
        $error = true;
        array_push($errors, "Password must contains 6 chars");
    }
    if ($password != $c_password) {
        $error = true;
        array_push($errors, "Password and confirmed password don`t match");
    }

    if (!$error) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $now = date_create()->format('Y-m-d H:i:s');
        $insert_query = "INSERT INTO users(`first_name`, `second_name`, `last_name`, `user_email`, `user_password`,`user_register_date`,`user_type`) VALUES('" . trim($first_name) . "','" . trim($second_name) . "', '" . trim($last_name) . "','" . trim($email) . "','" . $hash_password . "','" . $now . "','" . $user_type . "')";
        if (mysqli_query($conn, $insert_query)) {
            header('Location:login.php');
            $success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
            echo $success_message;
        } else {
            $error_message = "Error in registering...Please try again later! ";
            echo "<div class='error' >" . $error_message . mysqli_error($conn) . "</div>";
        }
    }
}
?>
    <body>
    <div id="login">
        <div class="container">
            <div class="profile-header">
                <!-- BEGIN profile-header-cover -->

                <!-- END profile-header-content -->
                <!-- BEGIN profile-header-tab -->
                <ul class="profile-header-tab nav nav-tabs">
                    <li class="nav-item"><a href="index.php" class="nav-link active show">POSTS</a>
                    </li>
                    <li class="nav-item"><a href="register.php" class="nav-link">REGISTER</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">LOGIN</a>
                    </li>
                </ul>
                <!-- END profile-header-tab -->
            </div>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form action="" class="form" id="login-form" method="post">
                        <?php
                        display_errors($errors);
                        ?>
                            <h3 class="text-center text-info">Register Form</h3>
                            <div class="form-group">
                                <label for="first name" class="text-info">First name:</label><br>
                                <input type="text" name="first_name" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Second name" class="text-info">Second name:</label><br>
                                <input type="text" name="second_name" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Last name:</label><br>
                                <input type="text" name="last_name" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="username" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_repeat" class="text-info">Password Repeat:</label><br>
                                <input type="text" name="c_password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_repeat" class="text-info">Choose your user role:</label>
                            </div>
                            <div class="form-group">
                                <label for="user_type" class="text-info">ADMIN</label>
                                <input type="radio" name="user_type" id="admin" class="" value="1">
                                <label for="User" class="text-info">USER</label>

                                <input type="radio" name="user_type" id="user" class="" value="2">

                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Register">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>

