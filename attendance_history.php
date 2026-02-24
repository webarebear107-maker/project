<?php
require "config.php";
session_start();

// Date filter
$date_filter = isset($_GET['date']) ? $_GET['date'] : '';

// Base query
$query = "SELECT * FROM time_in";

if (!empty($date_filter)) {
    $query .= " WHERE date_logged = '$date_filter'";
}

$query .= " ORDER BY date_logged DESC, time_logged DESC";

$res = mysqli_query($conn, $query);
$i = 1;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attendance History</title>

<link rel="stylesheet" href="css/bootstrap.min.css">

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

/* PAGE CONTAINER */
.page-container {
    padding: 30px;
}

/* CARD */
.attendance-card {
    background-color: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(30,58,138,0.15);
}

/* TITLE */
.page-title {
    font-size: 22px;
    font-weight: 600;
    color: #1e3a8a;
    margin-bottom: 20px;
}

/* TABLE */
.blue-table {
    border-collapse: collapse;
    width: 100%;
}

.blue-table th,
.blue-table td {
    padding: 10px;
    border: 1px solid #ccc;
}

.blue-table th {
    background-color: #16a34a;
    color: white;
}

.blue-table tbody tr:nth-child(even) {
    background-color: #f0f9ff;
}

/* BUTTONS */
.btn-primary {
    background-color: #2563eb;
    border: none;
}

.btn-primary:hover {
    background-color: #1d4ed8;
}

.btn-secondary {
    background-color: #64748b;
    border: none;
}

.btn-secondary:hover {
    background-color: #475569;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <h2>Ormoc City Division Attendance System</h2>
    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="masterlist.php">Master List</a>
        <a href="attendance_history_nav.php" class="active">Attendance History</a>
    </div>
</div>

<!-- CONTENT -->
<div class="page-container">
    <div class="attendance-card">

        <div class="page-title">Attendance History</div>

        <!-- DATE FILTER -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control"
                           value="<?= htmlspecialchars($date_filter) ?>">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="attendance_history.php" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        <!-- SEARCH -->
        <input type="text"
               id="searchInput"
               class="form-control mb-3"
               placeholder="Search name / LRN / level">

        <div class="table-responsive">
            <table class="blue-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>LRN</th>
                        <th>Full Name</th>
                        <th>Level</th>
                        <th>Date</th>
                        <th>Time In</th>
                    </tr>
                </thead>
                <tbody id="attendanceTable">
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['lrn']) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['level']) ?></td>
                        <td><?= htmlspecialchars($row['date_logged']) ?></td>
                        <td><?= date("h:i A", strtotime($row['time_logged'])) ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="js/jquery.min.js"></script>

<script>
// SEARCH FUNCTION
$("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#attendanceTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
</script>

</body>
</html>