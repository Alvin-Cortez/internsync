<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
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
                <a href="?page=dashboard" class="active">Dashboard</a>
                <a href="?page=logs">Activity Logs</a>
            </div>
        </div>
        <div class="nav-right">
            <span class="user-name"><?=$_SESSION['name'];?></span>
            <img src="profile-icon.png" alt="profile-icon" class="user-avatar">
            <a href="?page=logout" class="logout-link">Logout</a>
        </div>
    </nav>

    <main>
        <h2>Dashboard</h2>
        <!-- Internship Hours Summary -->
        <section class="time-tracking-card">
            <div class="time-tracking-header">
                <div>
                    <h3>Time Tracking</h3>
                    <p class="subtitle">Track your daily activities</p>
                </div>
                <div class="current-time" id="currentTime">11:10:48 AM</div>
            </div>
            <div class="time-tracking-content">
                <div class="current-activity">
                    <div class="current-activity-header">
                        <div>
                            <div class="current-activity-title">Current Activity</div>
                            <div class="current-activity-status" id="activityStatus">Not clocked in</div>
                        </div>
                        <div class="activity-timer" id="activityTimer">00:00:00</div>
                    </div>
                    <div class="activity-desc-label">Activity Description</div>
                    <textarea class="activity-desc-input" id="activityDesc" placeholder="What are you working on?" rows="3"></textarea>
                    <div class="activity-actions">
                        <button class="btn clock-in" id="clockInBtn"> Clock In</button>
                        <button class="btn clock-out" id="clockOutBtn"> Clock Out</button>
                    </div>
                </div>
                <div class="hours-summary">
                    <div class="hours-summary-header">
                        <div class="hours-summary-title">Internship Hours Summary</div>
                        <div class="hours-summary-subtitle">Track your progress towards completion</div>
                    </div>
                    <div class="summary-content">
                        <div class="progress-circle">
                            <svg width="70" height="70">
                                <circle cx="35" cy="35" r="30" stroke="#e5e7eb" stroke-width="7" fill="none"/>
                                <circle cx="35" cy="35" r="30" stroke="#4f46e5" stroke-width="7" fill="none"
                                    stroke-linecap="round"
                                    stroke-dasharray="188.4"
                                    stroke-dashoffset="116.8"
                                />
                            </svg>
                            <div class="progress-text">
                                <span><?=$timeSummary['renderedPercent']?>%</span>
                            </div>
                        </div>
                        <div class="summary-stats">
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-calendar">
                                    <svg width="20" height="20" fill="none"><rect x="3" y="5" width="14" height="12" rx="3" stroke="#4f46e5" stroke-width="2"/><rect x="7" y="2" width="2" height="4" rx="1" fill="#4f46e5"/><rect x="11" y="2" width="2" height="4" rx="1" fill="#4f46e5"/></svg>
                                </div>
                                <div>
                                    <div class="stat-label">Required Hours</div>
                                    <div class="stat-value"><?=$timeSummary['requiredHours']?>h</div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-check">
                                    <svg width="20" height="20" fill="none"><circle cx="10" cy="10" r="9" stroke="#22c55e" stroke-width="2"/><path d="M6 10.5l2.5 2.5 5-5" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                    <div class="stat-label">Total Hours</div>
                                    <div class="stat-value"><?=$timeSummary['renderedHours']?>h</div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-clock">
                                    <svg width="20" height="20" fill="none"><circle cx="10" cy="10" r="9" stroke="#f59e42" stroke-width="2"/><path d="M10 6v4l2.5 2.5" stroke="#f59e42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                    <div class="stat-label">Remaining Hours</div>
                                    <div class="stat-value"><?=$timeSummary['remainingHours']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Recent Activities Table -->
        <section class="recent-activities">
            <div class="activities-header">
                <h3>Recent Activities</h3>
                <span class="activities-subtitle">Your last 5 activities</span>
                <a href="?page=logs" class="view-all">View all</a>
            </div>
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>TIME IN</th>
                        <th>TIME OUT</th>
                        <th>HOURS</th>
                        <th>ACTIVITY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tasks)) {
                        foreach($tasks as $task){ ?>
                            <tr>
                                <td><?= htmlspecialchars(date('M d Y', strtotime($task['date']))) ?></td>
                                <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeIn']))) ?></td>
                                <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeOut']))) ?></td>
                                <?php $hours = floatval($task['totalHours']); ?>
                                <td><?= ($hours == intval($hours)) ? intval($hours) : $hours; ?></td>
                                <td><?= htmlspecialchars($task['activity']) ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">No recent activities</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="assets/js/dashboard.js"></script>
</body>
</html>