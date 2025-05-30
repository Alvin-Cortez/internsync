<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternSync</title>
    <link rel="stylesheet" href="assets/css/logs.css">
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
                <h1>Activity Logs</h1>
                <div class="header-icons">
                    <i class="fas fa-bell notification" id="notif-icon"></i>
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
            </header>
            <section class="table-section">
                <div class="table-actions">
                    <input type="text" class="search-input" placeholder="Search here...">
                    <button class="btn add-activity" onclick="openActivity()">Add Activity</button>
                </div>
                <div class="table-responsive">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Total Hours</th>
                                <th>Activity Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                            <tr>
                                <td>04/9/2024</td>
                                <td>9:00 AM</td>
                                <td>8:30 AM</td>
                                <td>7.5</td>
                                <td>Worked on project tasks</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <button class="prev">Previous</button>
                    <button class="page active">1</button>
                    <button class="page">2</button>
                    <button class="next">Next</button>
                </div>
            </section>
        </main>
    <?php include 'include/modal.php';?>
    <script src="assets/js/logs.js"></script>
</body>
</html>