<?php
require "config.php";
session_start();

var_dump($_SESSION); // see what’s in the session

if (!isset($_SESSION[''])) {
    echo "Redirecting...";
    header("Location: dashboard.php");
    exit();
}
