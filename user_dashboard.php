<?php
$page_title ="USER DASHBOARD";
include 'includes/db_connect.php';
include 'includes/header.php';

$select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_id ='" . $_SESSION['id'] . "'");
$result_user = mysqli_fetch_assoc($select_users);
//Избираме всички постове
$read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL";
$selectPosts = mysqli_query($conn, $read_post_query);
//намираме бр постове на всеки един потребител
$query_number_posts = "SELECT COUNT(*) FROM `posts` WHERE `user_id` ='" . $_SESSION['id'] . "'";
$res_number_posts = mysqli_query($conn, $query_number_posts);
$row = mysqli_fetch_array($res_number_posts);
$number_of_posts = $row[0];
//намираме бр коментари на всеки един потребител
$query_number_comments = "SELECT COUNT(*) FROM `comments` WHERE `user_id` ='" . $_SESSION['id'] . "'";
$res_number_comments = mysqli_query($conn, $query_number_comments);
$row_comment = mysqli_fetch_array($res_number_comments);
$number_of_comments = $row_comment[0];
?>
    <body>
<div style="background-color: #fff; " class="profile-header">
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
    <nav class="navbar navbar-light bg-white">
        <a href="#" class="navbar-brand">USER DASHBOARD</a>
        <form class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username"
                       aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h5"><?php echo "Welcome, " . $result_user['first_name']; ?></div>
                        <div class="h7 text-muted">Fullname:</div>
                        <div class="h7"><?php echo $result_user['first_name'] . ' ' . $result_user['second_name'] . ' ' . $result_user['last_name']; ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Number of posts</div>
                            <div class="h5"><?= $number_of_posts ?></div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Number of comments</div>
                            <div class="h5"><?=$number_of_comments?></div>
                        </li>

                        <li class="list-group-item">
                            <div class="btn-group">
                                <button class="btn btn-primary "><a class="text-white" href="logout.php">LOGOUT</a>
                                </button>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <form method="post" action="add_post.php" enctype="multipart/form-data">

                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                                       aria-controls="posts" aria-selected="true">Make
                                        a publication</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab"
                                       aria-controls="images"
                                       aria-selected="false" href="#images">Images</a>
                                    <input type="file" name="post_image">
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel"
                                     aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <input type="text" class="form-control" id="message"
                                               placeholder="Post title" name="post_title">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" id="message" rows="3"
                                                  placeholder="Post content" name="post_content"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <input type="url" class="form-control" id="message"
                                               placeholder="Post url" name="post_link">
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <input type="submit" class="btn btn-primary">
                                </div>

                            </div>
                        </div>
                </form>
            </div>
            <!-- Post /////-->

            <!--- \\\\\\\Post-->
            <div class="card gedf-card">
                <?php
                if ($selectPosts->num_rows > 0) {
                    while ($resultPosts = mysqli_fetch_assoc($selectPosts)) {
                        ?>
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">


                            </div>

                        </div>

                        <div class="card-body">

                            <div class="text-muted h7 mb-2"><i
                                        class="fa fa-clock-o"></i><?php echo $resultPosts['date_added']; ?></div>
                            <a class="card-link" href="show_post.php?id=<?php echo $resultPosts['post_id']; ?>">
                                <h5 class="card-title"><?php echo $resultPosts['post_title']; ?></h5>
                            </a>

                            <p class="card-text">
                                <?php echo substr($resultPosts['post_content'], 0, 160); ?>
                            </p>
                        </div>

                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>


<?php
include 'includes/footer.php'
?>