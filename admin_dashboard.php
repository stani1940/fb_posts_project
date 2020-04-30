<?php
$page_title = "Admin Panel";
//include 'includes/header.php';
include 'includes/db_connect.php';

$selectUser = mysqli_query($conn, "SELECT * FROM users WHERE user_id = ".$_SESSION['id']);
$resultUser = mysqli_fetch_assoc($selectUser);

if(isset($_SESSION['id'])){
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


    <title><?=$page_title?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet" type="text/css" >

    <link rel="stylesheet" type="text/css" href="styles/admin_panel.css">

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FB Posts Project</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="user_dashboard.php">Dashboard</a></li>
                <li><a href="index.php">Posts</a></li>
                <li><a href="users.php?id=<?php echo $_SESSION['id']; ?>">My Profil</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="user_dashboard.php">Welcome, <?php echo $resultUser['first_name']; ?></a></li>
                <li><a href="login.php">Logout</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<br>

<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
        </ol>
    </div>
</section>


<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.html" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        Dashboard <span class="badge">12</span>
                    </a>
                    <a href="pages.html" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages<span class="badge">25</span></a>
                    <a href="posts.html" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts<span class="badge">126</span></a>
                    <a href="users.html" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">12</span></a>
                </div>

                <div class="well">
                    <h4>Disk Space Used</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                    </div>
                    <h4>Bandwidth Used</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                            40%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:  #095f59;">
                        <h3 class="panel-title">Website Overview</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 12</h2>
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
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>126</h2>
                                <h4>Posts</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 2129</h2>
                                <h4>Visitores</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Latest User-->
                <div class="panel panel-default">
                    <div class="panel-heading"style="background-color:  #095f59;">
    <h3 class="panel-title">Latest Users</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                        </tr>

                        <tr>
                            <td>Madhav Prasad</td>
                            <td>mr.madhavprasad@gmail.com</td>
                            <td>Dec 13,2014</td>
                        </tr>
                        <tr>
                            <td>Nagendra Kushwaha</td>
                            <td>nkushwaha822@gmail.com</td>
                            <td>Feb 15,2014</td>
                        </tr>
                        <tr>
                            <td>Arun Kumar</td>
                            <td>kumarun@yahoo.com</td>
                            <td>Aug 17, 2015</td>
                        </tr>
                        <tr>
                            <td>Nabin Singh</td>
                            <td>singhNavs@outlook.com</td>
                            <td>March 08,2016</td>
                        </tr>
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


<?php
} else {
    header("Location: index.php");
}