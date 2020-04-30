<?php
$page_title = "FACEBOOK POSTS";
include 'includes/db_connect.php';
//pagination
//1 count number of result
$count_posts_query ="SELECT COUNT(*) AS number_of_posts FROM `posts` WHERE `post_delete` IS NULL ";
$result_count =mysqli_query($conn,$count_posts_query);
if( $result_count ){
    $row_count = mysqli_fetch_assoc( $result_count );
}
//2 set results per page to display
$posts_per_page = 5;
$number_of_pages = $row_count['number_of_posts']/$posts_per_page;
$number_of_pages = ceil($number_of_pages);
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
    $limit = $posts_per_page;
    $skip = ($current_page - 1) * $posts_per_page;
    $read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.post_url,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL LIMIT $skip, $limit";
}else{
    $read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.post_url,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL LIMIT 5";
    $current_page=1;
}
//Избираме всички постове
//$read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.post_url,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL LIMIT $skip, $limit";
$selectPosts = mysqli_query($conn, $read_post_query);
//Вземаме всички усери
//$selectUsers = mysqli_query($conn, "SELECT * FROM users WHERE user_banned IS NULL");
//Вземаме /броя на коментари
$selectComment = mysqli_query($conn, "SELECT COUNT(*) FROM comments c WHERE c.comment_delete IS NULL GROUP BY post_id ");
$count_likes_res=mysqli_query($conn, "SELECT COUNT(like_count) FROM like_posts l  GROUP BY post_id ");

//Вземаме потребителя с логнатата сесия
$select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_id ='" . $_SESSION['id'] . "'");
$result_user = mysqli_fetch_assoc($select_users);


if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/index.css">

    <title><?php echo $page_title ?></title>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
                <!-- begin profile -->
                <div class="profile">
                    <div class="profile-header">
                        <!-- BEGIN profile-header-cover -->

                        <!-- END profile-header-content -->
                        <!-- BEGIN profile-header-tab -->
                        <ul class="profile-header-tab nav nav-tabs">
                            <li class="nav-item"><a href="index.php" class="nav-link active show">POSTS</a>
                            </li>
                            <li class="nav-item"><a href="user_dashboard.php">ADD POST</a></li>
                            <li class="nav-item"><a href="user.php?id=<?php echo $_SESSION['id']; ?>" class="nav-link">MY PROFIL</a></li>
                            <li class="nav-item"><a href="logout.php" class="nav-link">LOGOUT</a>
                            </li>
                        </ul>
                        <!-- END profile-header-tab -->
                    </div>
                </div>
                <!-- end profile -->
                <!-- begin profile-content -->
                <div class="profile-content">
                    <!-- begin tab-content -->
                    <div class="tab-content p-0">
                        <!-- begin #profile-post tab -->
                        <div class="tab-pane fade active show" id="profile-post">
                            <!-- begin timeline -->
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">today</span>
                                        <span class="time">04:20</span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a>&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <div class="timeline-header">

                                            <?php
                                            if ($selectPosts->num_rows > 0) {
                                                while ($resultPosts = mysqli_fetch_assoc($selectPosts)) {
                                            ?>
                                            <span class="username"><a
                                                        href=""><?php echo $resultPosts['fn'];
                                                    echo " " . $resultPosts['ln']; ?></a> <small></small></span>
                                            <span class="userimage"><img
                                                        src="<?php echo $resultPosts['img_path']; ?>"
                                                        alt="pic" width="512px"></span>
                                            <span class="pull-right text-muted">     <?php echo $resultPosts['date_added']; ?></span>

                                            <div class="timeline-content">
                                                <p>
                                                    <a href="<?php echo $resultPosts['post_url']; ?>"><?php echo $resultPosts['post_title']; ?></a>
                                                </p>
                                                <p>
                                                    <?php echo substr($resultPosts['post_content'], 0, 160); ?>
                                                </p>
                                            </div>

                                            <div class="timeline-likes">
                                                <div class="stats-right">
                                                    <span class="stats-text">
                                                        <?php
                                                        if ($selectComment->num_rows > 0) {
                                                            if ($countComments = mysqli_fetch_array($selectComment)) {
                                                                echo $countComments[0] . " comments";
                                                            } else {
                                                                echo "No comments!";
                                                            }
                                                        }

                                                        ?>
                                                    </span>
                                                </div>

                                                        <div class="stats">
                                    <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                                    </span>
                                                            <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                    </span>
                                                            <span class="stats-total">
                                                                   <?php
                                                                   if ($count_likes_res->num_rows > 0) {
                                                                       if ($countLikes = mysqli_fetch_array($count_likes_res)) {
                                                                           echo $countLikes[0] . " like";
                                                                       } else {
                                                                           echo "No likes!";
                                                                       }
                                                                   }

                                                                   ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-body">

                                                        <div class="timeline-footer">
                                                            <a href="javascript:"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                                                Like</a>
                                                            <a href="javascript:;"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-comments fa-fw fa-lg m-r-3"></i>
                                                                Comment</a>
                                                            <a href="javascript:;"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                                        </div>
                                                    </div>
                                                    <?php

    }
} else {
    echo 'NO';
}
                                            ?>

                                            <!-- end timeline-body -->
                                </li>
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">yesterday</span>
                                        <span class="time">20:17</span>

                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <!-- pagination -->
                                        <nav aria-label="...." style="margin-left: 50px">
                                            <ul class="pagination">
                                                <!-- disable if first page -->
                                                <?php
                                                //10 check we are not on the first page
                                                if( $current_page != 1 ){
                                                    //previous link must lead to page - 1
                                                    $previous_num = $current_page - 1;
                                                    ?>
                                                    <li class="page-item"><a href="index.php?page=1"><span aria-hidden="true">&larr;</span> First</a></li>
                                                    <li class="page-item"><a href="index.php?page=<?= $previous_num ?>"><span aria-hidden="true">&larr;</span> Older</a></li>
                                                <?php } ?>
                                                <!-- step 4 - display number os pages in the pagination block -->
                                                <?php
                                                $current_num = 1;
                                                while ($current_num <= $number_of_pages ){ ?>
                                                    <!-- 7 - set page number requested in each page button -->
                                                    <!-- 9 - set dinamically active class - the current page number to be distinguished among others -->
                                                    <?php
                                                    $active_class = '';
                                                    if( $current_page == $current_num ){
                                                        $active_class = 'active';
                                                    }
                                                    ?>
                                                    <li class="<?= $active_class ?>"><a href="index.php?page=<?= $current_num ?>"><?= $current_num ?><span class="sr-only">(current)</span></a></li>
                                                    <?php $current_num++; } ?>
                                                <?php
                                                // 12 - check this is not the last page
                                                if( $current_page != $number_of_pages ){
                                                    //next link must lead to page + 1
                                                    $next_num = $current_page + 1;
                                                    ?>
                                                    <li class="next"><a href="index.php?page=<?= $next_num ?>">Newer <span aria-hidden="true">&rarr;</span></a></li>
                                                    <li class="next"><a href="index.php?page=<?= $number_of_pages ?>">Last <span aria-hidden="true">&rarr;</span></a></li>
                                                <?php } ?>
                                            </ul>
                                        </nav>
                                        <!-- end timeline-body -->
                                </li>
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">24 February 2014</span>
                                        <span class="time">08:17</span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">

                                    </div>
                        </div>
                        <!-- end timeline-body -->



                        <!-- end timeline -->
                    </div>
                    <!-- end #profile-post tab -->
                </div>
                <!-- end tab-content -->
            </div>
            <!-- end profile-content -->
        </div>
    </div>
</div>

<?php
} else {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/index.css">

    <title><?php echo $page_title ?></title>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
                <!-- begin profile -->
                <div class="profile">
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
                </div>
                <!-- end profile -->
                <!-- begin profile-content -->
                <div class="profile-content">
                    <!-- begin tab-content -->
                    <div class="tab-content p-0">
                        <!-- begin #profile-post tab -->
                        <div class="tab-pane fade active show" id="profile-post">
                            <!-- begin timeline -->
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">today</span>
                                        <span class="time">04:20</span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a>&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <div class="timeline-header">

                                            <?php
                                            if ($selectPosts->num_rows > 0) {
                                                while ($resultPosts = mysqli_fetch_assoc($selectPosts)) {
                                            ?>
                                            <span class="username"><a
                                                        href=""><?php echo $resultPosts['fn'];
                                                    echo " " . $resultPosts['ln']; ?></a> <small></small></span>
                                            <span class="userimage"><img
                                                        src="<?php echo $resultPosts['img_path']; ?>"
                                                        alt="pic" width="512px"></span>
                                            <span class="pull-right text-muted">     <?php echo $resultPosts['date_added']; ?></span>

                                            <div class="timeline-content">
                                                <p>
                                                    <a href="<?php echo $resultPosts['post_url']; ?>"><?php echo $resultPosts['post_title']; ?></a>
                                                </p>
                                                <p>
                                                    <?php echo substr($resultPosts['post_content'], 0, 160); ?>
                                                </p>
                                            </div>

                                            <div class="timeline-likes">
                                                <div class="stats-right">
                                                    <span class="stats-text">
                                                        <?php
                                                        if ($selectComment->num_rows > 0) {
                                                            if ($countComments = mysqli_fetch_array($selectComment)) {
                                                                echo $countComments[0] . " comments";
                                                            } else {
                                                                echo "No comments!";
                                                            }
                                                        }

                                                        ?>
                                                    </span>
                                                </div>

                                                        <div class="stats">
                                    <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                                    </span>
                                                            <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                    </span>
                                                            <span class="stats-total">
                                                                   <?php
                                                                   if ($count_likes_res->num_rows > 0) {
                                                                       if ($countLikes = mysqli_fetch_array($count_likes_res)) {
                                                                           echo $countLikes[0] . " like";
                                                                       } else {
                                                                           echo "No likes!";
                                                                       }
                                                                   }

                                                                   ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-body">

                                                        <div class="timeline-footer">
                                                            <a href="javascript:"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                                                Like</a>
                                                            <a href="javascript:;"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-comments fa-fw fa-lg m-r-3"></i>
                                                                Comment</a>
                                                            <a href="javascript:;"
                                                               class="m-r-15 text-inverse-lighter"><i
                                                                        class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                                        </div>
                                                    </div>
                                                    <?php

    }
} else {
    echo 'NO';
}
                                            ?>

                                            <!-- end timeline-body -->
                                </li>
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">yesterday</span>
                                        <span class="time">20:17</span>

                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <!-- pagination -->
                                        <nav aria-label="...." style="margin-left: 50px">
                                            <ul class="pagination">
                                                <!-- disable if first page -->
                                                <?php
                                                //10 check we are not on the first page
                                                if( $current_page != 1 ){
                                                    //previous link must lead to page - 1
                                                    $previous_num = $current_page - 1;
                                                    ?>
                                                    <li class="page-item"><a href="index.php?page=1"><span aria-hidden="true">&larr;</span> First</a></li>
                                                    <li class="page-item"><a href="index.php?page=<?= $previous_num ?>"><span aria-hidden="true">&larr;</span> Older</a></li>
                                                <?php } ?>
                                                <!-- step 4 - display number os pages in the pagination block -->
                                                <?php
                                                $current_num = 1;
                                                while ($current_num <= $number_of_pages ){ ?>
                                                    <!-- 7 - set page number requested in each page button -->
                                                    <!-- 9 - set dinamically active class - the current page number to be distinguished among others -->
                                                    <?php
                                                    $active_class = '';
                                                    if( $current_page == $current_num ){
                                                        $active_class = 'active';
                                                    }
                                                    ?>
                                                    <li class="<?= $active_class ?>"><a href="index.php?page=<?= $current_num ?>"><?= $current_num ?><span class="sr-only">(current)</span></a></li>
                                                    <?php $current_num++; } ?>
                                                <?php
                                                // 12 - check this is not the last page
                                                if( $current_page != $number_of_pages ){
                                                    //next link must lead to page + 1
                                                    $next_num = $current_page + 1;
                                                    ?>
                                                    <li class="next"><a href="index.php?page=<?= $next_num ?>">Newer <span aria-hidden="true">&rarr;</span></a></li>
                                                    <li class="next"><a href="index.php?page=<?= $number_of_pages ?>">Last <span aria-hidden="true">&rarr;</span></a></li>
                                                <?php } ?>
                                            </ul>
                                        </nav>
                                        <!-- end timeline-body -->
                                </li>
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">24 February 2014</span>
                                        <span class="time">08:17</span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">

                                    </div>
                        </div>
                        <!-- end timeline-body -->



                        <!-- end timeline -->
                    </div>
                    <!-- end #profile-post tab -->
                </div>
                <!-- end tab-content -->
            </div>
            <!-- end profile-content -->
        </div>
    </div>
</div>

<?php
}
include 'includes/footer.php';
?>

