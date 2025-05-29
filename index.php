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
                <i class="fas fa-bell notification" id="notif-icon"></i>
                <div class="avatar-icon">
                    <img src="assets/images/profile-icon.png" alt="User Avatar" id="profile-icon" onclick="openModal()">
                    <div class="dropdown-menu" id="profile-dropdown">
                        <ul>
                            <li>Account Settings</li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section class="dashboard">
                <div class="cards">
                    <div class="card">
                        <i class="fas fa-clock"></i>
                        <h3>Rendered Hours</h3>
                        <p>5.5 hrs</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-hourglass-half"></i>
                        <h3>Total Time Spent</h3>
                        <p>22.0 hrs</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-hourglass-end"></i>
                        <h3>Remaining Time</h3>
                        <p>2.5 hrs</p>
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
                            <tr>
                                <td>Apr 12, 2024</td>
                                <td>5.5</td>
                                <td>Worked on project X</td>
                            </tr>
                            <tr>
                                <td>Apr 11, 2024</td>
                                <td>5.5</td>
                                <td>Worked on project X</td>
                            </tr>
                            <tr>
                                <td>Apr 10, 2024</td>
                                <td>5.5</td>
                                <td>Worked on project X</td>
                            </tr>
                            <tr>
                                <td>Apr 9, 2024</td>
                                <td>6.0</td>
                                <td>Client meeting</td>
                            </tr>
                            <tr>
                                <td>Apr 8, 2024</td>
                                <td>4.0</td>
                                <td>Code review</td>
                            </tr>
                            <tr>
                                <td>Apr 7, 2024</td>
                                <td>6.5</td>
                                <td>Developed new feature</td>
                            </tr>
                            <tr>
                                <td>Apr 6, 2024</td>
                                <td>5.0</td>
                                <td>Team collaboration</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
    </main>
    <?php include 'include/modal.php';?>
    <script src="assets/js/index.js"></script>
</body>
</html>