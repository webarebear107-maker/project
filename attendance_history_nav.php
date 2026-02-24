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

/* MAIN SECTION */
.wrapper {
    height: 50vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* TITLE */
h1 {
    margin-bottom: 50px;
    font-size: 26px;
    font-weight: 600;
    color: #1e3a8a;
}

/* BUTTON GRID */
.button-grid {
    display: flex;
    gap: 40px;
}

/* BUTTON STYLE (same as dashboard) */
.square-btn {
    width: 240px;
    height: 240px;
    border-radius: 18px;
    text-decoration: none;
    font-size: 20px;
    font-weight: 600;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.25s ease;
    box-shadow: 0 8px 20px rgba(30,58,138,0.15);
}

/* TIME IN HISTORY */
.time-in {
    background-color: #2563eb;
    color: white;
}

.time-in:hover {
    background-color: #1d4ed8;
    transform: translateY(-5px);
}

/* TIME OUT HISTORY */
.time-out {
    background-color: #0ea5e9;
    color: white;
}

.time-out:hover {
    background-color: #0284c7;
    transform: translateY(-5px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .button-grid {
        flex-direction: column;
        gap: 25px;
    }

    .square-btn {
        width: 200px;
        height: 200px;
        font-size: 18px;
    }
}

</style>
</head>

<body>

<div class="header">
    <h2>Ormoc City Division Attendance System</h2>

    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="masterlist.php">Master List</a>
        <a href="attendance_history_nav.php" class="active">Attendance History</a>
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

<div class="wrapper">

    <h1>Attendance History</h1>

    <div class="button-grid">
        <a href="attendance_history.php" class="square-btn time-in">
            TIME IN HISTORY
        </a>

        <a href="attendance_history1.php" class="square-btn time-out">
            TIME OUT HISTORY
        </a>
    </div>

</div>

</body>
</html>