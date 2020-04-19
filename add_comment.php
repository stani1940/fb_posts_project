<?php
include 'includes/db_connect.php';

if ($_POST) {
    $user_id = $_SESSION['id'];
    $post_id = $_POST['post_id'];
    //var_dump($post_id);
    $comment_content = $_POST['comment'];
    $insert_comment_query = "INSERT INTO `comments` ( `user_id`, `post_id`, `comment_content`, `date_added`) VALUES ( '" . $user_id . "', '" . $post_id . "', '" . $comment_content . "', NOW())";
    $add_comment_res = mysqli_query($conn, $insert_comment_query);
    if ($add_comment_res) {

        header('Location:show_post.php?id='.$post_id);
        echo "Comment is added successfully!!!";
    } else {
        echo mysqli_error($conn);
    }

}