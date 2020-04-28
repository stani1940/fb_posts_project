<?php
include 'includes/db_connect.php';
$page_title = "Show post";
include 'includes/header_post.php';
if (isset($_SESSION['id'])) {
    if ($_GET['id']) {
        $selected_post_id = $_GET['id'];
        //Вземаме всичко за поста с даденото ID
        $read_post_query = "SELECT p.post_id,p.post_title,p.post_content,p.post_url,p.image,p.date_added,p.user_id,p.date_edit,u.user_id,u.last_name,u.first_name,u.img_path
       FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_id = " . $_GET['id'];
        $selectPost = mysqli_query($conn, $read_post_query);
        //Вземаме всички коментари за дадения пост по ID
        $read_comment_query = "SELECT c.post_id,c.comment_content,c.date_added,c.comment_edit,c.user_id,p.post_id,u.user_id,u.first_name,u.last_name 
    FROM comments c LEFT JOIN posts p ON c.post_id = p.post_id LEFT JOIN users u ON c.user_id = u.user_id WHERE c.post_id = " . $_GET['id'];
        $selectComment = mysqli_query($conn, $read_comment_query);
        $select_count_comments = mysqli_query($conn, "SELECT COUNT(*) FROM comments c WHERE c.comment_delete IS NULL AND c.post_id =" . $_GET['id']);

        $selectLikes = mysqli_query($conn, "SELECT * FROM like_posts WHERE post_id = " . $_GET['id']);
        $resultLike = mysqli_fetch_assoc($selectLikes);

        if ($selectPost->num_rows > 0) {
            while ($resultPost = mysqli_fetch_assoc($selectPost)) {

                $pageTitle = $resultPost['post_title'];

                if ($resultPost['date_edit'] == NULL) {
                    $action = "added";
                    $post_title = $resultPost['post_title'];
                    $post_content = $resultPost['post_content'];
                    $first_name = $resultPost['first_name'];
                    $last_name = $resultPost['last_name'];
                    $date_added = $resultPost['date_added'];
                    $user_image = $resultPost['img_path'];
                    $post_image = $resultPost['image'];
                    $post_url = $resultPost['post_url'];
                    $user_id = $_SESSION['id'];
                } else {
                    $action = "edited ";

                    $post_title = $resultPost['post_title'];
                    $post_content = $resultPost['post_content'];
                    $first_name = $resultPost['first_name'];
                    $last_name = $resultPost['last_name'];
                    $date_added = $resultPost['date_added'];
                    $user_image = $resultPost['img_path'];
                    $post_image = $resultPost['image'];
                    $post_url = $resultPost['post_url'];
                    $user_id = $_SESSION['id'];
                }
            }
        } else {
            echo "No";
        }
    }
    ?>
    <style>
        <!--
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        Hero

        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        =
        -->
        body {

        }

        .hero {
            padding: 6.25rem 0px !important;
            margin: 0px !important;
            background-color: #17a2b8;
        }

        .cardbox {
            border-radius: 3px;
            margin-bottom: 20px;
            padding: 0px !important;
        }

        /* ------------------------------- */
        /* Cardbox Heading
        ---------------------------------- */
        .cardbox .cardbox-heading {
            padding: 16px;
            margin: 0;
        }

        .cardbox .btn-danger {
            border-radius: 50%;
            font-size: 24px;
            height: 32px;
            width: 72px;
            padding: 0;
            overflow: hidden;
            color: #fff !important;
            background: #b5b6b6;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cardbox .float-right .dropdown-menu {
            position: relative;
            left: 13px !important;
        }

        .cardbox .float-right a:hover {
            background: #f4f4f4 !important;
        }

        .cardbox .float-right a.dropdown-item {
            display: block;
            width: 100%;
            padding: 4px 0px 4px 10px;
            clear: both;
            font-weight: 400;
            font-family: 'Abhaya Libre', serif;
            font-size: 14px !important;
            color: #848484;
            text-align: inherit;
            white-space: nowrap;
            background: 0 0;
            border: 0;
        }

        /* ------------------------------- */
        /* Media Section
        ---------------------------------- */
        .media {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }
    </style>
    <body>
<section class="hero">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 offset-lg-3">

                <div class="cardbox shadow-lg bg-white">

                    <div class="cardbox-heading">
                        <!-- START dropdown-->
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="update_post.php?id=<?php echo $selected_post_id ?>">Update
                                    post</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">LOG OUT</a>
                            </div>
                        </div><!--/ dropdown -->
                        <div class="media m-0">
                            <div class="d-flex mr-3">
                                <a href=""><img class="img-fluid rounded-circle"
                                                src="<?php echo $user_image ?>"
                                                alt="User" width="150px"></a>
                            </div>
                            <div class="media-body">
                                <p class="m-0"><?php echo $action . " by " . $first_name . ' ' . $last_name ?></p>
                                <span><i class="icon ion-md-pin"></i> <?php echo $post_title; ?></span>
                                <p><i class="icon ion-md-time"></i> <?php echo "date: " . $date_added; ?></p>
                            </div>
                        </div><!--/ media -->
                    </div><!--/ cardbox-heading -->

                    <div class="cardbox-item">
                        <img class="img-fluid"
                             src="<?php echo $post_image ?>"
                             alt="Image" width="600px">
                        <p class="text-justify"><?php echo $post_content ?></p>
                    </div><!--/ cardbox-item -->
                    <div class="cardbox-base">
                        <ul class="float-right">
                            <a><i class="fa fa-comments"></i></a>
                            <em class="mr-5"><?php
                                if ($select_count_comments->num_rows > 0) {
                                    if ($countComments = mysqli_fetch_array($select_count_comments)) {
                                        echo $countComments[0] . " comments";
                                    } else {
                                        echo "No comments!";
                                    }
                                }

                                ?>
                            </em>
                        </ul>
                        <ul>
                            <?php
                            $likeSelect = mysqli_query($conn, "SELECT * FROM like_posts WHERE post_id = " . $_GET['id'] . " AND user_id = " . $user_id);
                            $res = mysqli_fetch_array($likeSelect);
                            //var_dump($res);
                            //exit;
                            if (empty($res)) {
                                ?>
                                <form method="post" action="">
                                    <button class="btn btn-primary" type="submit" name="like"><i
                                                class="fa fa-thumbs-up"></i></button>
                                </form><?php
                                $likes = 0;
                                if (isset($_POST['like'])) {
                                    $likes++;
                                    $insertLike = mysqli_query($conn, "INSERT INTO like_posts (like_count,user_id,post_id) VALUES ('" . $likes . "','" . $user_id . "','" . $_GET['id'] . "')");
                                }
                            } else {
                                echo 'No';
                            }
                            ?>
                            <span>
                                <?php
                                $count_likes_res=mysqli_query($conn, "SELECT COUNT(like_count) FROM like_posts WHERE post_id = " . $_GET['id']);
                                        if (mysqli_num_rows( $count_likes_res)>0){
                                            if($count_likes = mysqli_fetch_array($count_likes_res)){
                                                echo $count_likes[0] . " likes";
                                            }


                                        }

                                ?>
                            </span>
                        </ul>
                    </div><!--/ cardbox-base -->
                    <div class="cardbox-comments">

                        <div class="search text-center">
                            <form method="post" action="add_comment.php">
                                <input type="hidden" name="post_id" value="<?php echo $selected_post_id ?>">
                                <label for="comment"></label>
                                <input type="text" placeholder="Write a comment" name="comment" id="comment">
                                <input type="submit"><i class="fa fa-camera"></i>
                            </form>
                        </div>

                        <?php
                        while ($commentResult = mysqli_fetch_assoc($selectComment)) {
                            if ($commentResult['comment_edit'] != NULL) {
                                ?>
                                <p><i>Added from
                                        <?php echo $commentResult['first_name'] . " " . $commentResult['last_name'] . " | Дата: " . $commentResult['date_added'] . " | Редакритан: " . $commentResult['comment_edit']; ?>
                                        <br/></i>
                                    <?php echo $commentResult['comment_content']; ?></p>
                                <?php
                            } else {
                                ?>
                                <p><i>Added from:
                                        <?php echo $commentResult['first_name'] . " | Дата: " . $commentResult['date_added'] ?>
                                        <br/></i>
                                    <?php echo $commentResult['comment_content']; ?></p>
                                <?php
                            }
                        }
                        ?>
                        <!--/. Search -->
                    </div><!--/ cardbox-like -->

                </div><!--/ cardbox -->

            </div><!--/ col-lg-6 -->
            <div class="col-lg-3">
                <div class="shadow-lg p-4 mb-2 bg-white author">
                    <a href="<?php echo $post_url ?>">Get more from post</a>
                    <p>Bootstrap 4.1.0</p>
                </div>
            </div><!--/ col-lg-3 -->

        </div><!--/ row -->
    </div><!--/ container -->
</section>

    <?php
    include 'includes/footer.php';
} else {
    echo 'No';
}
