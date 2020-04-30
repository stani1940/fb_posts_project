<?php

include 'db_connect.php';

$deletePost = mysqli_query($conn, "SELECT * FROM posts WHERE post_id = ".$_GET['id']);

$resultPost = mysqli_fetch_assoc($deletePost);

if($_GET['id'] == $resultPost['post_id']){
    $softDelete = mysqli_query($conn, "UPDATE posts SET post_delete = 1 WHERE post_id = ".$_GET['id']);
    if(!$softDelete){
        echo mysqli_error($conn);
    } else {
    header("Location:user.php?id=".$_SESSION['id']);
    exit;        
    }
}

