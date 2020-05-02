<?php
$page_title = "Admin Panel";
//include 'includes/header.php';
include 'includes/db_connect.php';
$select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_id ='" . $_SESSION['id'] . "'");
$result_user = mysqli_fetch_assoc($select_users);
$read_users = mysqli_query($conn, "SELECT * FROM users");
$sql = "SELECT COUNT(*) FROM users";
$read_posts = mysqli_query($conn, "SELECT * FROM posts");
$sql_post = "SELECT COUNT(*) FROM posts";
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?= $page_title ?></title>

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
                <!--<li><a href="comments.php">COMMENTS</a></li>-->
                <!--<li><a href="users.php">USERS</a></li>-->
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
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">Create Content
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Add Pages</a></li>
                        <li><a href="#">Add Posts</a></li>
                        <li><a href="#">Add Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<br>
<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.html" class="list-group-item active main-color-bg"><span
                                class="glyphicon glyphicon-cog" aria-hidden="true"></span>

                    </a>
                    <a href="pages.html" class="list-group-item"><span class="glyphicon glyphicon-list-alt"
                                                                       aria-hidden="true"></span> COMMENTS<span
                                class="badge">25</span></a>
                    <a href="posts.html" class="list-group-item"><span class="glyphicon glyphicon-pencil"
                                                                       aria-hidden="true"></span> POSTS<span
                                class="badge">  <?php
                            if ($result_post = mysqli_query($conn, $sql_post)) {
                                $row = mysqli_fetch_row($result_post);
                                $count = $row[0];
                            }
                            echo $count;
                            ?></span></a>
                    <a href="users.html" class="list-group-item"><span class="glyphicon glyphicon-user"
                                                                       aria-hidden="true"></span> USERS <span
                                class="badge"><?php
                            $count = 0;
                            if ($result = mysqli_query($conn, $sql)) {
                                $row = mysqli_fetch_row($result);
                                $count = $row[0];
                            }
                            echo $count;
                            ?></span></a>
                </div>

                <div class="well">
                    <h4>Disk Space Used</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                             aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                    </div>
                    <h4>Bandwidth Used</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                             aria-valuemax="100" style="width: 40%;">
                            40%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Website Overview</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    <?php
                                    if ($result = mysqli_query($conn, $sql)) {
                                        $row = mysqli_fetch_row($result);
                                        $count = $row[0];
                                    }
                                    echo $count;
                                    ?></h2>
                                <h4>Users</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 25</h2>
                                <h4>Pages</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="read_posts.php">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        <?php
                                        if ($result_post = mysqli_query($conn, $sql_post)) {
                                            $row = mysqli_fetch_row($result_post);
                                            $count = $row[0];
                                        }
                                        echo $count;
                                        ?>
                                    </h2>
                                    <h4>CRUD POSTS</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 2129</h2>
                                <h4>Visitors</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Latest User-->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:  #095f59;">
    <h3 class=" panel-title">Latest Users</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <?php if (mysqli_num_rows($read_users) > 0) { ?>
                            <tr>
                                <th>BANNED</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Update</th>
                                <th>Ban</th>
                                <th></th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($read_users)) {
                                ?>
                                <tr>
                                    <?php
                                    if($row['user_banned'] == 1){
                                        ?>
                                    <td><a href="banuser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger">BANNED</a></td>
                                    <?php
                                    } else {
                                        echo '<td></td>';
                                    }
                                    ?>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                    <td><?php echo $row['user_email'] ?></td>
                                    <td><?php echo $row['user_register_date'] ?></td>
                                    <td><a href="user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-primary">Update Profil</a></td>
                                    <td><a href="banuser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger">Ban User</a></td>
                                </tr>


                                <?php
                            }
                        }
                        ?>
                    </table>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="dist/js/bootstrap.min.js"></script>

<?php
include 'includes/footer.php'
?>

