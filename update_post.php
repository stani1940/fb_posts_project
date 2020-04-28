<?php
$page_title = "Update post";
include 'includes/header.php';
include 'includes/db_connect.php';
if ($_GET['id']) {
    $postID = $_GET['id'];

    $selectPost = mysqli_query($conn, "SELECT * FROM posts WHERE post_id=" . $postID);

    if ($selectPost->num_rows > 0) {
        $postInfo = mysqli_fetch_assoc($selectPost);
        ?>
        <body>
    <div id="login">
        <h3 class="text-center text-white pt-5">UPDATE POST</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post" action="" enctype="multipart/form-data">
                            <h3 class="text-center text-info">UPDATE </h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Post Title:</label>
                                <input type="text" class="form-control" id="username" name="post_title"
                                       value="<?php echo $postInfo['post_title']; ?>"/>
                            </div>
                            <div class="form-group">

                                <label for="username" class="text-info">Post Content:</label>

                                <textarea class="form-control" id="username" name="post_content" rows="4" cols="50">
                                    <?php echo $postInfo['post_content']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                Post URL: <input type="url" name="post_url" class="form-control"
                                                 value="<?php echo $postInfo['post_url']; ?>"/>
                            </div>
                            <input type="submit" class="btn btn-danger" name="update_post" value="Update Post"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php

        if ($_POST) {
            $postTitle = $_POST['post_title'];
            $postContent = $_POST['post_content'];
            $postUrl = $_POST['post_url'];

            $updatePost = mysqli_query($conn, "UPDATE posts SET post_title = '" . $postTitle . "', post_content = '" . $postContent . "', post_url = '" . $postUrl . "', date_edit = NOW() WHERE post_id = " . $postID);

            if (!$updatePost) {
                echo mysqli_error($conn);
            } else {
                echo "Поста е обновен успешно!!!";
                header('Location:show_post.php?id='.$postID);
            }
        }

    }
}
include 'includes/footer.php';

?>