<?php
include 'includes/db_connect.php';
include 'includes/functions.php';
if (isset($_SESSION['id'])) {
    if ($_GET['id'] == $_SESSION['id']) {
        include 'errors.php';
        $errors = array();

        //Select user from $_GET['id']
        $selecUsers = mysqli_query($conn, "SELECT * FROM users WHERE user_id = " . $_GET['id']);
        $userInfo = mysqli_fetch_assoc($selecUsers);
        $page_title = "User: " . $userInfo['first_name'] . " " . $userInfo['last_name'];
        include 'includes/header.php';


        //Select all commentfrom from user where user_id = $_GET['id']
        $selectComments = mysqli_query($conn, "SELECT DISTINCT c.comment_content,c.date_added,c.comment_edit,c.user_id,p.post_title,p.post_id
            FROM comments c LEFT JOIN posts p ON c.post_id = p.post_id WHERE c.user_id = " . $_GET['id']);

        //Select all posts from user where user_id = $_GET['id']
        $selectPost = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = " . $_GET['id']);
        ?>
        <hr>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@icon/entypo@1.0.3/entypo.css" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="logout.php">Logout</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 ">
                    <div class="card left-profile-card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?php echo $userInfo['img_path']; ?>" alt="" class="user-profile">
                                <h3><?php echo $userInfo['first_name'] . " " . $userInfo['last_name']; ?></h3>
                            </div>
                            <hr />
                            <div class="personal-info">
                                <h3>Personal Information</h3>
                                <ul class="personal-list">
                                    <li><i class="fas fa-envelope-square"></i><span><?php echo $userInfo['user_email']; ?></span></li>
                                </ul>
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card right-profile-card">
                        <div class="card-header alert-primary">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-selected="true">My Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-education-tab" data-toggle="pill" href="#pills-education" role="tab" aria-selected="false">My Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#pills-timeline" role="tab" aria-selected="false">User Setings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="work-container">
                                        <?php
                                        while ($psInfo = mysqli_fetch_assoc($selectPost)) {
                                            ?>

                                            <h3><?php echo $psInfo['post_title']; ?></h3>
                                            <h4><i class="far fa-calendar-alt"></i><?php echo $psInfo['date_added']; ?> to <span class="badge badge-info">Current</span></h4>
                                            <p><?php echo $psInfo['post_content']; ?></p>

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-education" role="tabpanel">
                                    <div class="work-container">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Post Title</th>
                                                    <th scope="col">Comment</th>
                                                    <th scope="col">Date Added</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cmCount = 1;
                                                while ($cmInfo = mysqli_fetch_assoc($selectComments)) {
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $cmCount++; ?></th>
                                                        <td><?php echo $cmInfo['post_title']; ?></td>
                                                        <td><?php echo $cmInfo['comment_content']; ?></td>
                                                        <td><?php echo $cmInfo['date_added']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-timeline" role="tabpanel">
                                    <div class="row">
                                        <div class="card-body">
                                            <div id="login">
                                                <h3 class="text-center text-white pt-5">Update post form</h3>
                                                <div class="container">
                                                    <div id="login-row" class="row justify-content-center align-items-center">
                                                        <div id="login-column" class="col-md-6">
                                                            <div id="login-box" class="col-md-12">
                                                                <form id="login-form" class="form" method="post" action="" enctype="multipart/form-data">
                                                                    <h3 class="text-center text-info">UPDATE Setings</h3>
                                                                    <div class="form-group">
                                                                        <label for="username" class="text-info">Password:</label>
                                                                        <input type="password"  class="form-control" id="password" name="password"
                                                                               placeholder="Password"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="username" class="text-info">Re-Password:</label>
                                                                        <input type="password"  class="form-control" id="password" name="repassword"
                                                                               placeholder="Re-Password"/>
                                                                    </div>
                                                                    <input type="submit" class="btn btn-danger" name="update_post" value="Update Password"/>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($_POST) {
                                                $password = $_POST['password'];
                                                $repass = $_POST['repassword'];
                                                if ($password == $repass) {
                                                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                                                    $updateUser = mysqli_query($conn, "UPDATE users SET user_password = '" . $hash_password . "'  WHERE user_id = " . $_SESSION['id']);
                                                    if (!$updateUser) {
                                                        echo mysqli_error($conn);
                                                    } else {
                                                        echo "Паролата е обновена успешно!!!";
                                                        header('Location: user.php?id=', $_SESSION['id']);
                                                        ob_flush();
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">

        </script>

        <?php
    } elseif ($_SESSION['user_type'] == 1) {
        ob_start();
        $selecUsers = mysqli_query($conn, "SELECT * FROM users WHERE user_id = " . $_GET['id']);
        $userInfo = mysqli_fetch_assoc($selecUsers);
        $page_title = "User: " . $userInfo['first_name'] . " " . $userInfo['last_name'];
        include 'includes/header.php';
        ?>
        <hr>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@icon/entypo@1.0.3/entypo.css" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="logout.php">Logout</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 ">
                    <div class="card left-profile-card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?php echo $userInfo['img_path']; ?>" alt="" class="user-profile">
                                <h3><?php echo $userInfo['first_name'] . " " . $userInfo['last_name']; ?></h3>
                            </div>
                            <hr />
                            <div class="personal-info">
                                <h3>Personal Information</h3>
                                <ul class="personal-list">
                                    <li><i class="fas fa-envelope-square"></i><span><?php echo $userInfo['user_email']; ?></span></li>
                                </ul>
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card right-profile-card">
                        <div class="card-header alert-primary">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#pills-home" role="tab" aria-selected="false">User Setings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div lass="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="row">
                                        <div class="card-body">
                                            <div id="login">
                                                <h3 class="text-center text-white pt-5">Update post form</h3>
                                                <div class="container">
                                                    <div id="login-row" class="row justify-content-center align-items-center">
                                                        <div id="login-column" class="col-md-6">
                                                            <div id="login-box" class="col-md-12">
                                                                <form id="login-form" class="form" method="post" action="" enctype="multipart/form-data">
                                                                    <h3 class="text-center text-info">UPDATE PASSWORD</h3>
                                                                    <div class="form-group">
                                                                        <label for="email" class="text-info">Email:</label>
                                                                        <input type="text"  class="form-control" id="email" name="email"
                                                                               value="<?php echo $userInfo['user_email']; ?>"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password" class="text-info">Password:</label>
                                                                        <input type="password"  class="form-control" id="password" name="password"
                                                                               placeholder="Password"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password" class="text-info">Re-Password:</label>
                                                                        <input type="password"  class="form-control" id="password" name="repassword"
                                                                               placeholder="Re-Password"/>
                                                                    </div>
                                                                    <?php
                                                                    if($userInfo['user_banned'] == 1){
                                                                     ?>
                                                                    <div class="form-group">
                                                                        <label for="password" class="text-info">Remove Ban:</label>
                                                                        <input type="text"  class="form-control" id="unban" name="unban"
                                                                               value="<?php echo $userInfo['user_banned']; ?>"/>
                                                                    </div>                                                                    
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <input type="submit" class="btn btn-danger" name="update_post" value="Update Password"/>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($_POST) {
                                                $email = $_POST['email'];
                                                $password = $_POST['password'];
                                                $repass = $_POST['repassword'];

                                                if ($password == $repass) {
                                                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                                                    $updateUser = mysqli_query($conn, "UPDATE users SET user_password = '" . $hash_password . "', user_email = '" . $email . "', user_banned = NULL WHERE user_id = " . $_GET['id']);
                                                    if (!$updateUser) {
                                                        echo mysqli_error($conn);
                                                    } else {
                                                        echo "Паролата е обновена успешно!!!";
                                                        header('Location: admin_dashboard.php');
                                                        ob_flush();
                                                    }
                                                } else {
                                                    
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">

        </script>
        <?php
    }
} else {
    echo "<p>Please Login</p>";
    header('Location:index.php');
}
include 'includes/footer.php';
