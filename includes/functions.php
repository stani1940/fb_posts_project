<?php
include 'includes/db_connect.php';
// CREATE FUNCTION TO REMOVE SLASHES AND TO REMOVE SPACES

function inject_checker($conn,$field)
{
    return (htmlentities(trim(mysqli_real_escape_string($conn,$field))));
}
//// CREATE FUNCTION TO login with prepare statement in PDO
function login($pdo,$login_email,$login_password)
{
    $sql = "SELECT * FROM users WHERE user_email = :user_email";
    $stmt = $pdo->prepare($sql);

//Bind value.
    $stmt->bindValue(':user_email', $login_email);

//Execute.
    $stmt->execute();

//Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        array_push($errors, "Your email is wrong!!!");

    } else {
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        $validPassword = password_verify($login_password, $user['user_password']);

        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {

            //Provide the user with a login session.
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['user_password'] = $user['user_password'];
            $_SESSION['user_type'] = $user['user_type'];

            //Redirect to our protected page, which we called home.php
            if ($user['user_type'] == 1) {
                header('Location:admin_dashboard.php');
            } else {
                header('Location:user_dashboard.php');
            }

        } else {
            //$validPassword was FALSE. Passwords do not match.
            array_push($errors, "Incorrect email|password combination!!! ");
        }
    }
}