<?php
$page_title ="CRUD POSTS";
include 'includes/db_connect.php';
include 'includes/header.php';
$read_post_query = "SELECT p.post_id,p.user_id,p.post_title,p.post_content,p.post_url,p.date_added,p.post_delete,u.user_id,u.first_name as fn,u.last_name as ln, u.img_path FROM posts p LEFT JOIN users u ON p.user_id = u.user_id WHERE p.post_delete IS NULL ";
$selectPosts = mysqli_query($conn, $read_post_query);
?>
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