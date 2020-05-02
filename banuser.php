<?php

ob_start();
include 'includes/db_connect.php';
$deleteUser = mysqli_query($conn, "SELECT * FROM users WHERE user_id = " . $_GET['id']);
$resultUser = mysqli_fetch_assoc($deleteUser);

if ($_GET['id'] == $resultUser['user_id']) {
    $banUser = mysqli_query($conn, "UPDATE users SET user_banned = 1 WHERE user_id = " . $_GET['id']);
    if (!$banUser) {
        echo mysqli_error($conn);
        exit;
    }
    header("Location: admin_dashboard.php");
    ob_flush();
}

//echo '<pre>';
//var_dump($resultUser);
//echo '</pre>';

