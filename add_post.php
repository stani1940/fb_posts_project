<?php
$pageTitle = "Add post";
include 'includes/db_connect.php';
include 'includes/header.php';
include 'errors.php';
$errors =array();

if ($_POST) {

    $id = $_SESSION['id'];

    $postTitle = $_POST['post_title'];
    $postTitle = filter_var($postTitle, FILTER_SANITIZE_STRING);
    if (empty($postTitle)){
        $error =true;
        array_push($errors,"Please fill text in field title");
    }

    $postContent = $_POST['post_content'];
    $postContent = filter_var($postContent, FILTER_SANITIZE_STRING);
    if (empty($postContent)){
        $error =true;
        array_push($errors,"Please fill text in field content");

    }
    $postUrl = $_POST['post_link'];
    $postUrl = filter_var($postUrl, FILTER_SANITIZE_URL);
    if (!filter_var($postUrl, FILTER_VALIDATE_URL)){
        $error =true;
        array_push($errors,"Please fill valid url");

    }


        //the upload dir must exist - created before first upload
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['post_image']['name']);
        $filename = basename($_FILES['post_image']['name']);
        // validate file input
        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $upload_file)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
        $image = $upload_file;
        if (!$error) {

            $addPost = mysqli_query($conn, "INSERT INTO posts (post_title,post_content,post_url,image,date_added,user_id) VALUES ('" . $postTitle . "','" . $postContent . "','" . $postUrl . "','" . $upload_file . "' , NOW(), '" . $id . "')");

            if ($addPost) {
                echo "Post is added successfully!!!";
                header('Location:user_dashboard.php');
            } else {
                die(mysqli_error($conn));
            }
        }else{
            $_SESSION['error_message']=$errors;
            header('Location:user_dashboard.php');

        }
}


include 'includes/footer.php';
