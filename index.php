<?php 
    session_start();
    include 'class/Db.php';
    include 'class/UserActivity.php';
    $data = new userActivity();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternSync</title>
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="profile">
            <div class="logo">
                <img src="assets/images/logo.png" alt="Company Logo">
            </div>
        </div>
        <nav class="menu">
            <a href="index.php" class="menu-item" id="dashboard-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="logs.php" class="menu-item" id="logs-link">
                <i class="fas fa-file-alt"></i> Activity Logs
            </a>
        </nav>
        <p>&copy; Copyright 2025</p>
    </aside>
    <main class="main-content">
        <header class="header">
            <button class="hamburger" id="hamburger-btn">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Dashboard</h1>
            <div class="header-icons">
                <div class="avatar-icon">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <img src="assets/images/profile-icon.png" alt="User Avatar" id="profile-icon" onclick="openModal()">
                    <?php else: ?>
                        <img src="assets/images/profile-icon.png" alt="User Avatar" id="profile-icon" onclick="toggleProfileDropdown()">
                    <?php endif;?>
                    <div class="dropdown-menu" id="profile-dropdown">
                        <ul>
                            <li>Account Settings</li>
                            <li><a href="include/logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section class="dashboard">
                <div class="cards">
                    <div class="card">
                        <i class="fas fa-clock"></i>
                        <h3>Required Hours</h3>
                        <?php
                            if(isset($_SESSION['user_id'])){
                                $renderedHours = $data->getUserRequiredHours($_SESSION['user_id']);
                                echo "<p>" .$renderedHours ." hrs</p>";
                            } else{
                                echo "<p> -- hrs </p>";
                            }
                        ?>
                    </div>
                    <div class="card">
                        <i class="fas fa-hourglass-half"></i>
                        <h3>Total Time Spent</h3>
                        <?php
                            if(isset($_SESSION['user_id'])){
                                $spentHours = $data->totalTimeSpent($_SESSION['user_id']);
                                if($spentHours == 0){echo "<p> 0 hrs</p>";} else {
                                echo "<p>" .$spentHours ." hrs</p>";}
                            } else {
                                echo "<p> -- hrs </p>";
                            }
                            
                        ?>
                    </div>
                    <div class="card">
                        <i class="fas fa-hourglass-end"></i>
                        <h3>Remaining Time</h3>
                        <?php 
                            if(isset($_SESSION['user_id'])){
                                $remaining = $data->getRemainingTime($_SESSION['user_id']);
                                echo "<p>" .$remaining ." hrs</p>";
                            } else {
                                echo "<p> -- hrs </p>";
                            }      
                        ?>
                    </div>
                </div>
        
                <!-- Recent Activities Table -->
                <div class="recent-activities">
                    <h3>Recent Activities</h3>
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hours Rendered</th>
                                <th>Activity Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_SESSION['user_id'])){
                                    $activity = new userActivity();
                                    $logs = $activity->getRecentLogs($_SESSION['user_id']);
                                    foreach($logs as $log){
                                        echo "<tr>";
                                        echo "<td>". htmlspecialchars(date('M d Y', strtotime($log['date']))) ."</td>";
                                        $hours = floatval($log['totalHours']);
                                        echo "<td>";
                                        echo ($hours == intval($hours)) ? intval($hours) : $hours;
                                        echo "</td>";
                                        echo "<td>". htmlspecialchars($log['activity']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<td colspan=3>Sign in first to display your progress</td>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
    </main>
    <?php include 'include/modal.php';?>
    <script src="assets/js/index.js"></script>
</body>
</html>