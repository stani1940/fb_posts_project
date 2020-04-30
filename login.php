<?php
$page_title = "LOGIN";
include 'includes/header.php';
include 'includes/db_connect.php';
//include 'includes/functions.php';
include 'errors.php';
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field = "";
    function inject_checker($conn,$field)
    {
        return (htmlentities(trim(mysqli_real_escape_string($conn,$field))));
    }
    $login_email = inject_checker($conn, $_POST['email']);
    $login_password = inject_checker($conn, $_POST['password']);

    if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Valid Email is required");

    }
    if (empty($login_password)) {
        array_push($errors, "Password field is required!!!");
    } else {


            $sql = "SELECT * FROM users WHERE user_email = :user_email";
            $stmt = $pdo->prepare($sql);

//Bind value.
            $stmt->bindValue(':user_email', $login_email);

//Execute.
            $stmt->execute();

//Fetch row.
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user === false) {
                //Could not find a user with that username!
                //PS: You might want to handle this error in a more user-friendly manner!
                array_push($errors, "Your email is wrong!!!");

            } else {
                //User account found. Check to see if the given password matches the
                //password hash that we stored in our users table.

                //Compare the passwords.
                $validPassword = password_verify($login_password, $user['user_password']);

                //If $validPassword is TRUE, the login has been successful.
                if ($validPassword) {

                    //Provide the user with a login session.
                    $_SESSION['id'] = $user['user_id'];
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_password'] = $user['user_password'];
                    $_SESSION['user_type'] = $user['user_type'];

                    //Redirect to our protected page, which we called home.php
                    if ($user['user_type'] == 1) {
                        header('Location:admin_dashboard.php');
                    } else {
                        header('Location:user_dashboard.php');
                    }

                } else {
                    //$validPassword was FALSE. Passwords do not match.
                    array_push($errors, "Incorrect email|password combination!!! ");
                }
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
                    <form id="login-form" class="form"
                          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php
                        display_errors($errors);
                        ?>
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="username" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
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