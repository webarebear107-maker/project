<?php
require "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ormoc City Division Attendance System</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/ocshs3.png">

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

        .logo-group-left,
        .logo-group-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-group-left img,
        .logo-group-right img {
            height: 100px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
            color: #1e3a8a;
            margin-left: 10px;
            margin-top: -20px;
        }

        /* SCANNER + TABLE */
        .page-container {
            padding: 30px;
        }

        .attendance-card {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(30,58,138,0.15);
        }

        #reader {
            width: 100%;
            border: 2px solid #ccc;
            border-radius: 8px;
        }

        .styled-table th {
            color: white;
        }

        .blue-table {
            border-collapse: collapse;
            width: 100%;
        }

        .blue-table th, .blue-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .blue-table tbody tr:nth-child(even) {
            background-color: #f0f9ff;
        }

        @media (max-width: 768px) {
            .logo-group-left img,
            .logo-group-right img {
                height: 70px;
            }

            .logo-text {
                font-size: 16px;
            }
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
    <div class="attendance-card">
        <div class="row">

            <!-- SCANNER -->
            <div class="col-md-4">
                <h5 class="text-center mb-3">Scan QR Code</h5>
                <div id="reader"></div>
                <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
                    <div class="alert alert-danger text-center mt-2">
                        ❌ Invalid QR Code
                    </div>
                <?php endif; ?>
                <form id="scanForm" action="save_attendance.php" method="POST">
                    <input type="hidden" name="qr_code" id="qr_code">
                </form>
            </div>

            <!-- TABLE -->
            <div class="col-md-8">
                <h5>Attendance Records</h5>
                <input type="text" id="searchInput" class="form-control mb-2" placeholder="Search name / LRN / section">
                <div class="table-responsive">
                    <table class="styled-table blue-table">
                        <thead class="thead-dark">
                        <tr style="background-color: #dc2626;">
                            <th>LRN</th>
                            <th>Full Name</th>
                            <th>Level</th>
                            <th>Date</th>
                            <th>Time Out</th>
                        </tr>
                        </thead>
                        <tbody id="attendanceTable">
                        <?php
                        $today = date('Y-m-d');
                        $query = "SELECT * FROM time_out WHERE date_logged = '$today' ORDER BY time_logged DESC";
                        $res = mysqli_query($conn, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)):
                        ?>
                            <tr>
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
    </div>
</div>

<!-- JS -->
<script src="js/jquery.min.js"></script>
<script src="js/html5-qrcode.min.js"></script>

<script>
const html5QrCode = new Html5Qrcode("reader");

Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
        let cameraId = devices[0].id;

        html5QrCode.start(
            cameraId,
            {
                fps: 30,
                qrbox: { width: 350, height: 350 }
            },
            (decodedText) => {
                document.getElementById("qr_code").value = decodedText;
                html5QrCode.stop().then(() => {
                    document.getElementById("scanForm").submit();
                });
            }
        );
    }
}).catch(err => {
    alert("Camera error: " + err);
});
</script>

</body>
</html>
