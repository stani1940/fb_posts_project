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
                                            <form method="post" action="">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputFirstName">First name</label>
                                                        <input type="text" class="form-control" id="inputFirstName" placeholder="<?php echo $userInfo['first_name']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputLastName">Last name</label>
                                                        <input type="text" class="form-control" id="inputLastName" placeholder="<?php echo $userInfo['last_name']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail4">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail4" placeholder="<?php echo $userInfo['user_email']; ?>" readonly>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputFirstName">Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputLastName">Re-Passwod</label>
                                                        <input type="password" name="repassword" class="form-control" placeholder="Re-password">
                                                    </div>
                                                </div>
                                                <input type="submit" name="repassword" name="update" class="btn btn-primary" value="Save changes" />
                                            </form>
                                                        <?php
            if (isset($_POST['update'])) {
                                    var_dump($_POST);
                    exit;
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];
                $has_pass = password_hash($password, PASSWORD_DEFAULT);
                if (strlen($password) > 6) {
                    echo 'NO1';
                    exit;
                } elseif ($password != $repassword) {
                    echo 'NO2';
                    exit;
                } else {
                    $updatePass = mysqli_query($conn, "UPDATE users SET user_password = " . $has_pass . " WHERE user_id =" . $_GET['id']);
                    if (!$updatePass) {
                        echo mysqli_error($conn);
                        exit;
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
    }
} else {
    echo "<p>Please Login</p>";
    header('Location:index.php');
}
include 'includes/footer.php';
