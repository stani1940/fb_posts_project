<?php
// CREATE FUNCTION TO REMOVE SLASHES AND TO REMOVE SPACES
function inject_checker($conn, $field)
{
    return (htmlentities(trim(mysqli_real_escape_string($conn, $field))));
}