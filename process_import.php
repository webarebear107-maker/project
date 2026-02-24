<?php
require "config.php";
require "vendor/autoload.php"; // Make sure composer installed PhpSpreadsheet
include 'phpqrcode/qrlib.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_FILES['excel_file'])) {
    die("No file uploaded.");
}

$fileName = $_FILES['excel_file']['tmp_name'];

$spreadsheet = IOFactory::load($fileName);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();

$imported = 0;

foreach ($rows as $index => $row) {
    // Skip header row
    if ($index < 9) continue;
    if (empty($row[8])) continue;

    $number      = trim($row[0]);
    $level       = trim($row[1]);
    $event       = trim($row[2]);
    $lastname    = trim($row[3]);
    $firstname   = trim($row[4]);
    $mi          = trim($row[5]); 
    $sex         = trim($row[6]);
    $school      = trim($row[7]);
    $lrn         = trim($row[8]);
    $type        = trim($row[9]);

    if (empty($lrn) || empty($firstname) || empty($lastname)) continue;

    // Check for duplicate LRN
    $check = mysqli_query($conn, "SELECT id FROM masterlist WHERE lrn='$lrn'");
    if (mysqli_num_rows($check) > 0) continue;

    // Insert into database
    $sql = "INSERT INTO masterlist
        (`#`, lrn, level, event, lastname, firstname, mi, sex, school, type)
        VALUES
        ('$number','$lrn','$level','$event','$lastname','$firstname','$mi','$sex','$school','$type')";

    if (mysqli_query($conn, $sql)) {
        $imported++;
    }
}

// Feedback and redirect
echo "
<script>
    alert('$imported students imported successfully!');
    window.location.href = 'masterlist.php';
</script>
";
