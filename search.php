<?php
include 'includes/db_connect.php';
include 'includes/header_post.php';
include 'errors.php';
?>
    <nav class="navbar navbar-light bg-white">
        <a href="#" class="navbar-brand">USER DASHBOARD</a>
        <form class="form-inline" method="post" action="search.php">

            <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username"
                       aria-describedby="button-addon2" name="search_string">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2" name="search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>
<?php
$errors = array();

if (isset($_POST['search'])) {
    if (!empty($_POST['search_string'])&& is_string($_POST['search_string'])) {

        $read_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL AND(p.post_title LIKE '%" . $_POST['search_string'] . "%' OR  p.post_content LIKE '%" . $_POST['search_string'] . "%')";

//var_dump($read_query);

        $result = mysqli_query($conn, $read_query);
        function escape_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $search = escape_input($_POST['search_string']);

        ?>
        <div class="card gedf-card">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($resultPosts = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">


                        </div>

                    </div>

                    <div class="card-body">

                        <div class="text-muted h7 mb-2"><i
                                    class="fa fa-clock-o"></i><?php echo $resultPosts['date_added']; ?></div>
                        <a class="card-link" href="show_post.php?id=<?php echo $resultPosts['post_id']; ?>">
                            <h5 class="card-title"><?php echo $resultPosts['post_title']; ?></h5>
                        </a>

                        <p class="card-text">
                            <?php echo substr($resultPosts['post_content'], 0, 160); ?>
                        </p>
                    </div>

                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>


        <?php
    } else {
        array_push($errors, "Please enter string");
        display_errors($errors);
    }
}
?>


<?php
include 'includes/footer.php'
?>