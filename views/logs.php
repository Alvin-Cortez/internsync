<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/logs.css">
    <link rel="stylesheet" href="assets/css/profile-modal.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>InternSync</title>
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <svg width="35" height="35" viewBox="0 0 28 28" fill="#4F46E5">
                <circle cx="14" cy="14" r="12" stroke="#4F46E5" stroke-width="3"/>
                <rect x="13" y="7" width="2" height="8" rx="1" fill="#ffffff"/>
                <rect x="14" y="14" width="6" height="2" rx="1" fill="#ffffff" transform="rotate(45 14 14)"/>
            </svg>
            <span class="logo-text">InternSync</span>
            <div class="nav-links">
                <a href="?page=dashboard">Dashboard</a>
                <a href="?page=logs" class="active">Activity Logs</a>
            </div>
        </div>
        <div class="nav-right">
            <span class="user-name" id="openProfileModal"><?=$_SESSION['name'];?></span>
            <a href="?page=logout" class="logout-link">Logout</a>
        </div>
    </nav>

    <div id="toast-container"></div>

    <main>
        <div class="logs-container">
            <h2 class="logs-title">Activity Logs</h2>
            <div class="logs-subtitle">View and manage all your tracked activities</div>
            <div class="logs-card">
                <div class="logs-filters">
                    <div class="searchbar">
                        <input type="text" class="search-bar" placeholder="Search here.." id="search">
                        <span></span>
                    </div>
                    <div class="logs-actions">
                        <button class="logs-add-btn">Add Activity</button>
                        <button class="logs-export-btn">Export Report</button>
                    </div>
                </div>
                <table class="logs-table">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>TIME IN</th>
                            <th>TIME OUT</th>
                            <th>HOURS</th>
                            <th>ACTIVITY</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="logs-pagination">
                    <span class="logs-summary-text">Showing 1 to 10 of 54 results</span>
                    <div class="logs-pagination-btns"></div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'views/modal.php'; ?>
    <script src="assets/js/logs.js"></script>
</body>
</html>