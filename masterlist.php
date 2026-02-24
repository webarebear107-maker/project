<?php
require "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Master List</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="icon" type="image/png" href="images/deped region8.png">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #eef4ff;
}

/* HEADER */
.header {
    background-color: #1e3a8a;
    padding: 18px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    color: white;
}

.nav a {
    margin-left: 25px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    color: #dbeafe;
    transition: 0.2s ease;
}

.nav a:hover {
    color: #ffffff;
}

.nav .active {
    color: #ffffff;
    font-weight: 600;
}

.logout {
    color: #fecaca !important;
}

/* LOGO ROW */
.logo-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px;
}

/* PAGE CONTAINER */
.page-container {
    padding: 30px;
}

/* CARD */
.master-card {
    background-color: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(30,58,138,0.15);
}

/* TITLE + ACTION */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.page-header h1 {
    font-size: 22px;
    font-weight: 600;
    color: #1e3a8a;
    margin: 0;
}

/* BUTTON */
.btn-primary {
    background-color: #2563eb;
    border: none;
}

.btn-primary:hover {
    background-color: #1d4ed8;
}

/* TABLE */
.blue-table {
    border-collapse: collapse;
    width: 100%;
}

.blue-table th,
.blue-table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.blue-table th {
    background-color: #1e3a8a;
    color: white;
}

.blue-table tbody tr:nth-child(even) {
    background-color: #f0f9ff;
}

/* DELETE BUTTON */
.btn-delete {
    background-color: #dc2626;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-delete:hover {
    background-color: #b91c1c;
}

/* SEARCH */
.table-search {
    margin-bottom: 15px;
}

</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <h2>Ormoc City Division Attendance System</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="masterlist.php" class="active">Master List</a>
        <a href="attendance_history_nav.php">Attendance History</a>
    </div>
</div>


<div style="display: flex; justify-content: space-between; align-items: center; margin: 20px;">
    
    <!-- Left side: Logo + Text -->
    <div style="display: flex; align-items: center;">
        <img src="images/ormoc seal.png" alt="Dashboard Image" 
             style="width:120px; margin-top:-40px; margin-left:30px; margin-right:10px;">
             <img src="images/deped region8.png" alt="Siglaro Logo" style="width:110px; margin-top:-40px; margin-right:10px;">
        <p style="margin:0; margin-top:-40px; font-size:20px; font-weight:bold; color:#1e3a8a;">
            <i>Department of Education</i><br>
            Region No. VIII<br>
            ORMOC CITY DIVISION
        </p>
    </div>

    <!-- Right side: Another logo -->
    <div>
        <img src="images/siglaro.png" alt="Siglaro Logo" style="width:120px; margin-top:-50px; margin-right:10px;">
        <img src="images/sdo.png" alt="Siglaro Logo" style="width:120px; margin-top:-50px; margin-right:10px;">
        <img src="images/Seal_of_the_Department_of_Education_of_the_Philippines.png" alt="Siglaro Logo" style="width:120px; margin-top:-50px; margin-right:30px;">
    </div>

</div>
<!-- CONTENT -->
<div class="page-container">
    <div class="master-card">

        <div class="page-header">
            <h1>Master List</h1>
            <a href="import_excel.php" class="btn btn-primary">Import Excel</a>
        </div>

        <!-- SEARCH -->
        <input type="text" id="searchInput"
               class="form-control table-search"
               placeholder="Search LRN, Name, Level...">

        <div class="table-responsive">
            <table class="blue-table" id="masterTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Level</th>
                        <th>Event</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>MI</th>
                        <th>Sex</th>
                        <th>School</th>
                        <th>LRN</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $qry = "SELECT * FROM masterlist ORDER BY id ASC, lastname ASC";
                $result = mysqli_query($conn, $qry);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['#']) ?></td>
                        <td><?= htmlspecialchars($row['level']) ?></td>
                        <td><?= htmlspecialchars($row['event']) ?></td>
                        <td><?= htmlspecialchars($row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['firstname']) ?></td>
                        <td><?= htmlspecialchars($row['mi']) ?></td>
                        <td><?= htmlspecialchars($row['sex']) ?></td>
                        <td><?= htmlspecialchars($row['school']) ?></td>
                        <td><?= htmlspecialchars($row['lrn']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td>
                            <a href="deleteinfo.php?id=<?= $row['id'] ?>"
                               class="btn-delete"
                               onclick="return confirm('Delete this record?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
$("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#masterTable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
</script>

</body>
</html>