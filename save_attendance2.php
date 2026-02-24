<?php
require "config.php";
session_start();

if (isset($_POST['qr_code'])) {
    $lrn = mysqli_real_escape_string($conn, $_POST['qr_code']);

    // Check if LRN exists in masterlist
    $check = mysqli_query($conn, "SELECT * FROM masterlist WHERE lrn = '$lrn'");

    if (mysqli_num_rows($check) > 0) {
        $student = mysqli_fetch_assoc($check);

        $fullname = $student['lastname'] . " " . $student['firstname'] . ". " . $student['mi'];
        $level    = $student['level']; // ✅ pull level/section from masterlist
        $today    = date('Y-m-d');
        $time     = date('H:i:s');

        // Prevent duplicate time-in for today
        $duplicate = mysqli_query(
            $conn,
            "SELECT * FROM time_out 
             WHERE lrn='$lrn' AND date_logged='$today'"
        );

        if (mysqli_num_rows($duplicate) == 0) {
            mysqli_query(
                $conn,
                "INSERT INTO time_out (lrn, fullname, level, date_logged, time_logged)
                 VALUES ('$lrn', '$fullname', '$level', '$today', '$time')"
            );

            header("Location: time_out.php?success=recorded");
            exit();
        } else {
            header("Location: time_out.php?error=duplicate");
            exit();
        }
    } else {
        header("Location: time_out.php?error=invalid");
        exit();
    }
}
?>
