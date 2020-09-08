<?php
$page_title = "REGISTER";
include 'includes/header.php';
include 'includes/functions.php';
include 'errors.php';
$errors=$_SESSION['errors'];
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
                    <form action="register_script.php" class="form" id="login-form" method="post">
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
                            <input type="password" name="c_password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_repeat" class="text-info">Choose your user role:</label>
                        </div>
                        <div class="form-group">
                            <label for="admin" class="text-info">ADMIN</label>
                            <input type="radio" name="user_type" id="admin" class="" value="1">
                            <label for="user" class="text-info">USER</label>

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

