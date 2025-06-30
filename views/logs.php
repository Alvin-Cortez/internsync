<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/logs.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
            <span class="user-name"><?=$_SESSION['name'];?></span>
            <img src="profile-icon.png" alt="profile-icon" class="user-avatar">
            <a href="?page=logout" class="logout-link">Logout</a>
        </div>
    </nav>

    <main>
        <div class="logs-container">
            <h2 class="logs-title">Activity Logs</h2>
            <div class="logs-subtitle">View and manage all your tracked activities</div>
            <div class="logs-card">
                <div class="logs-filters">
                    <div class="searchbar">
                        <input type="text" class="search-bar" placeholder="Search here..">
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
    <!--Add Activity Modal-->
    <div class="modal-overlay" id="addActivityModal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" id="closeAddModal">&times;</button>
            <h3 class="modal-title">Add New Activity</h3>
            <form class="modal-form" id="modal-add" method="post">
                <label class="modal-label" for="modal-date">Date</label>
                <input type="text" id="modal-date" class="modal-input" placeholder="mm/dd/yy" autocomplete="off" name="date">

                <div class="modal-row">
                    <div>
                    <label class="modal-label" for="modal-time-in">Time In</label>
                    <input type="text" id="modal-time-in" name="time-in" class="modal-input" placeholder="08:00 am">
                    </div>
                    <div>
                    <label class="modal-label" for="modal-time-out">Time Out</label>
                    <input type="text" id="modal-time-out" name="time-out" class="modal-input" placeholder="06:00 pm">
                    </div>
                </div>

                <label class="modal-label" for="modal-desc">Activity Description</label>
                <textarea id="modal-desc" name="activity" class="modal-textarea" placeholder="Describe your activity"></textarea>

                <div class="modal-actions">
                    <button type="button" class="modal-cancel">Cancel</button>
                    <button type="submit" class="modal-save">Save Activity</button>
                </div>
            </form>
        </div>
    </div>

    <!--Edit Activity Modal-->
    <div class="modal-overlay" id="editActivityModal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" id="closeEditModal">&times;</button>
            <h3 class="modal-title">Edit New Activity</h3>
            <form class="modal-form" id="modal-edit"  method="post">
                <input type="hidden" id="edit-log-id" name="log_id">
                <label class="modal-label" for="modal-date">Date</label>
                <input type="text" id="modal-date" class="modal-input" placeholder="dd/mm/yyyy" name="edit-date" autocomplete="off">

                <div class="modal-row">
                    <div>
                    <label class="modal-label" for="modal-time-in">Time In</label>
                    <input type="text" id="modal-time-in" name="edit-timeIn" class="modal-input" placeholder="--:-- --">
                    </div>
                    <div>
                    <label class="modal-label" for="modal-time-out">Time Out</label>
                    <input type="text" id="modal-time-out" name="edit-timeOut" class="modal-input" placeholder="--:-- --">
                    </div>
                </div>

                <label class="modal-label" for="modal-desc">Activity Description</label>
                <textarea id="modal-desc" class="modal-textarea" name="edit-desc" placeholder="Describe your activity"></textarea>

                <div class="modal-actions">
                    <button type="button" class="modal-cancel" id="edit-cancel">Cancel</button>
                    <button type="submit" class="modal-save">Save Activity</button>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/logs.js"></script>
</body>
</html>