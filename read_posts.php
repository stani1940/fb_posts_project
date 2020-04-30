<?php
$page_title ="CRUD POSTS";
include 'includes/db_connect.php';
//include 'includes/header.php';
$select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_id ='" . $_SESSION['id'] . "'");
$result_user = mysqli_fetch_assoc($select_users);
$read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.post_url,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL ";
$selectPosts = mysqli_query($conn, $read_post_query);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title><?= $page_title ?></title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="styles/admin_panel.css">

    </head>
    <body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="read_posts.php">POSTS</a></li>
                <li><a href="comments.php">COMMENTS</a></li>
                <li><a href="users.php">USERS</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><?php echo "Welcome, Admin: " . $result_user['first_name']; ?></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a>
                    <a href="user_dashboard.php" <button class="btn btn-primary">Create Content</button></a>


                </div>
            </div>
        </div>
    </div>
</header>
    <table class="table table-stripped">
        <tr>
            <td>№</td>
            <td><h5 class="card-title">Author</h5></td>
            <td><h5 class="card-title">Title</h5></td>
            <td><h5 class="card-title">Content</h5></td>
            <td><h5 class="card-title">Date publishing</h5</td>
            <td>EDIT</td>
            <td>DELETE</td>
        </tr>
        <?php
        $num = 1;
        if ($selectPosts->num_rows > 0) {
        while ($resultPosts = mysqli_fetch_assoc($selectPosts)) {
        ?>

        <tr>
            <td><?= $num++ ?></td>
            <td>
                <h5 class="card-title"><?php echo $resultPosts['fn'] . " " . $resultPosts['ln']; ?></h5>

            </td>
            <td>
                <h5 class="card-title"><?php echo $resultPosts['post_title']; ?></h5>

            </td>
            <td>
                <?php echo substr($resultPosts['post_content'], 0, 160); ?>
            </td>
            <td>
                <?php echo $resultPosts['date_added']; ?>
            </td>
            <td><a href="update_post.php?id=<?= $resultPosts['post_id'] ?>" class="btn btn-warning">UPDATE</a></td>
            <td><a href="delete_post.php?id=<?= $resultPosts['post_id'] ?>" class="btn btn-danger">Delete</a></td>


            <?php
            }
            }
            ?>
        </tr>
    </table>
<?php
include 'includes/footer.php';
?>