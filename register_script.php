<?php
include 'includes/db_connect.php';
if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $second_name = mysqli_real_escape_string($conn, $_POST['second_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $user_type = $_POST['user_type'];
    //var_dump( $user_type);
    function validateRegister($first_name, $second_name, $last_name, $email, $password, $c_password, $user_type, $conn)
    {
        $errors = array();
        if (!preg_match("/^[a-zA-Z ]+$/", $first_name)) {
            $error = true;
            array_push($errors, "First name is required must contain only alphabets and space");
        }
        if (!preg_match("/^[a-zA-Z ]+$/", $second_name)) {
            $error = true;
            array_push($errors, "Second name is required must contain only alphabets and space");
        }
        if (!preg_match("/^[a-zA-Z ]+$/", $last_name)) {
            $error = true;
            array_push($errors, "Last name is required must contain only alphabets and space");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            array_push($errors, "Valid email is required");
        }
        function isUserExist($conn,$email){
            $select_query = "SELECT * FROM `users` WHERE `user_email`= '".$email."'";
            $result = mysqli_query($conn,$select_query);
            if(mysqli_num_rows($result)>=1)
            {
                return false;
            }else{
                return true;
            }
        }
        if (!isUserExist($conn,$email)){
            $error =true;
            array_push($errors, "User with this email already exist");
        }

        function isValidPassLength($password)
        {
            if (strlen($password) < 6) {
                return false;
            } else {
                return true;
            }
        }

        if (!isValidPassLength($password)) {
            $error=true;
            array_push($errors, "Password must contains 6 chars");
        }

        if ($password !== $c_password) {
            $error = true;
            array_push($errors, "Password and confirmed password don`t match");
        }

        if (!$error) {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $now = date_create()->format('Y-m-d H:i:s');
            $insert_query = "INSERT INTO users(`first_name`, `second_name`, `last_name`, `user_email`, `user_password`,`user_register_date`,`user_type`) VALUES('" . trim($first_name) . "','" . trim($second_name) . "', '" . trim($last_name) . "','" . trim($email) . "','" . $hash_password . "','" . $now . "','" . $user_type . "')";
            if (mysqli_query($conn, $insert_query)) {
                header('Location:login.php');
                $success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
                echo $success_message;
            } else {
                $error_message = "Error in registering...Please try again later! ";
                echo "<div class='error' >" . $error_message . mysqli_error($conn) . "</div>";
            }
        } else {
            $_SESSION['errors'] = $errors;

            header('Location:register.php');

        }
    }

    validateRegister($first_name, $second_name, $last_name, $email, $password, $c_password, $user_type, $conn);


}