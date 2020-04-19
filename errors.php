<?php
function display_errors($errors)
{
    if (!empty($errors))
        if (count($errors) > 0) : ?>
            <div style="background-color: #7d0000;color: #f8f8f7" class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif;
}
//error_login($errors);
?>

