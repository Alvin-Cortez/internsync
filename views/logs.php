<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/logs.css">
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
                    <div>
                        <label class="logs-label">Date Range</label>
                        <select class="logs-select">
                            <option>This Week</option>
                            <option>Last Week</option>
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>Custom</option>
                        </select>
                    </div>
                    <div>
                        <label class="logs-label">Activity Type</label>
                        <select class="logs-select">
                            <option>All Activities</option>
                            <option>Meeting</option>
                            <option>Development</option>
                            <option>Research</option>
                        </select>
                    </div>
                    <button class="logs-filter-btn">Apply Filters</button>
                    <div class="logs-actions">
                        <button class="logs-add-btn" onclick="addActivity()">Add Activity</button>
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
                        <?php if(!empty($tasks)){
                            foreach($tasks as $task){?>
                                <tr>
                                    <td><?= htmlspecialchars(date('M d Y', strtotime($task['date']))) ?></td>
                                    <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeIn']))) ?></td>
                                    <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeOut']))) ?></td>
                                    <?php $hours = floatval($task['totalHours']); ?>
                                    <td><?= ($hours == intval($hours)) ? intval($hours) : $hours; ?></td>
                                    <td><?= htmlspecialchars($task['activity']) ?></td>
                                    <td class="logs-actions">
                                        <p class="logs-edit" onclick="editActvity()">Edit</p>
                                        <p class="logs-delete">Delete</p>
                                    </td>
                                </tr><?php
                            }
                        } else {?>
                            <tr>
                                <td colspan="6">No Activities</td>
                            </tr><?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="logs-pagination">
                    <span>Showing <?= (($page - 1) * 10) + 1 ?> to <?= min($page * 10, $total) ?> of <?= $total ?> results</span>
                    <div class="logs-pagination-btns">
                        <?php if ($page > 1): ?>
                            <button><a href="?page=logs&p=<?= $page - 1 ?>">&lt;</a></button>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <button><a href="?page=logs&p=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a></button>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <button><a href="?page=logs&p=<?= $page + 1 ?>">&gt;</a></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Add Activity Modal-->
    <div class="modal-overlay" id="addActivityModal" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" onclick="closeAddModal()">&times;</button>
            <h3 class="modal-title">Add New Activity</h3>
            <form class="modal-form" method="post" action="?page=add-logs">
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
    <div class="modal-overlay" id="editActivityModal" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" onclick="closeEditModal()">&times;</button>
            <h3 class="modal-title">Edit New Activity</h3>
            <form class="modal-form">
            <label class="modal-label" for="modal-date">Date</label>
            <input type="text" id="modal-date" class="modal-input" placeholder="dd/mm/yyyy" autocomplete="off">

            <div class="modal-row">
                <div>
                <label class="modal-label" for="modal-time-in">Time In</label>
                <input type="text" id="modal-time-in" class="modal-input" placeholder="--:-- --">
                </div>
                <div>
                <label class="modal-label" for="modal-time-out">Time Out</label>
                <input type="text" id="modal-time-out" class="modal-input" placeholder="--:-- --">
                </div>
            </div>

            <label class="modal-label" for="modal-desc">Activity Description</label>
            <textarea id="modal-desc" class="modal-textarea" placeholder="Describe your activity"></textarea>

            <div class="modal-actions">
                <button type="button" class="modal-cancel">Cancel</button>
                <button type="submit" class="modal-save">Save Activity</button>
            </div>
            </form>
        </div>
    </div>
    <script src="assets/js/logs.js"></script>
</body>
</html>