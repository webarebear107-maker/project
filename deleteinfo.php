<?php
require "config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("Location: masterlist.php");
    exit;
}

// DELETE STUDENT AUTOMATICALLY
mysqli_query($conn, "DELETE FROM masterlist WHERE id='$id'");

// Redirect immediately back to masterlist
header("Location: masterlist.php");

exit;
?>
