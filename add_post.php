<?php
$pageTitle = "ADD POST";
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_POST) {
    $id = $_SESSION['id'];

    $postTitle = $_POST['post_title'];
    $postContent = $_POST['post_content'];
    $postUrl = $_POST['post_link'];

    //the upload dir must exist - created before first upload
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($_FILES['post_image']['name']);
    $filename = basename($_FILES['post_image']['name']);
    // step 2 validate file input
    if (move_uploaded_file($_FILES['post_image']['tmp_name'], $upload_file)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }
    $image = $upload_file;
    $addPost = mysqli_query($conn, "INSERT INTO posts (post_title,post_content,post_url,image,date_added,user_id) VALUES ('" . $postTitle . "','" . $postContent . "','" . $postUrl . "','" . $upload_file . "' , NOW(), '" . $id . "')");

    if ($addPost) {
        echo "Post is added successfully!!!";
        header('Location:user_dashboard.php');
    } else {
        echo mysqli_error($conn);
    }
}


include 'includes/footer.php';
