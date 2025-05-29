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
                        <img src="assets/images/profile-icon.png" alt="User Avatar" id="profile-icon" onclick="toggleProfileDropdown()">
                    <div class="dropdown-menu" id="profile-dropdown">
                        <ul>
                            <li>Account Settings</li>
                            <li><a href="logout.php">Log Out</a></li>
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
    <!--Modal-->
    <div class="modal-background" id="modal-container">
        <div class="modal-container">
            <img class="modal-logo" src="assets/images/logo.png" alt="InternSync Logo">
            <span id="close-modal" onclick="closeModal()">&times;</span>
            <div class="buttons">
                <button type="button" class="btn-primary active" id="sign-in-btn" onclick="toggleSignIn()">Sign-In</button>
                <button type="button" class="btn-secondary" id="sign-up-btn" onclick="toggleSignUp()">Sign Up</button>
            </div>
            <form action="include/signin.inc.php" method="POST">
                <div class="form-group" id="sign-in-form">
                    <label for="signin-username">Username</label>
                    <input type="text" id="signin-username" name="username">
                    <label for="signin-password">Password</label>
                    <input type="password" id="signin-password" name="password">
                    <button type="submit" class="btn btn-submit" name="signin-submit">Submit</button>
                    <div class="message">
                        <p>Don't have an account? <button type="button" onclick="toggleSignUp()">Sign Up</button></p>
                    </div>
                </div>
            </form>
            <form action="include/signup.inc.php" method="POST">
                <div class="form-group" style="display: none;" id="sign-up-form">
                    <label for="signup-username">Username</label>
                    <input type="text" id="signup-username" name="username">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="password">
                    <label for="cPassword">Confirm Password</label>
                    <input type="password" id="cPassword" name="cPass">
                    <label for="hours" class="hours-input">Hours to Render</label>
                    <input type="number" id="hours" name="hours" class="hours-input">
                    <button type="submit" class="btn btn-submit" name="signup-submit">Submit</button>
                    <div class="message">
                        <p>Already have an account? <button type="button" onclick="toggleSignIn()">Sign In</button></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="add-modal-background" id="add-activity-modal">
        <div class="modal-container">
            <span onclick="closeAddActivityModal()" style="position:absolute;top:10px;right:20px;font-size:30px;cursor:pointer;color:#969696;">&times;</span>
            <h2 style="color:#fff;margin-bottom:20px;">Add Activity</h2>
            <form id="add-activity-form">
                <div class="form-group">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="activity-date">Date</label>
                            <input type="date" id="activity-date" name="date" required>
                        </div>
                        <div class="input-group">
                            <label for="activity-time-in">Time In</label>
                            <input type="time" id="activity-time-in" name="time_in" required>
                        </div>
                        <div class="input-group">
                            <label for="activity-time-out">Time Out</label>
                            <input type="time" id="activity-time-out" name="time_out" required>
                        </div>
                    </div>
                    <div class="activity-desc-group">
                        <label for="activity-desc">Activity Description</label>
                        <input type="text" id="activity-desc" name="activity" maxlength="100" required>
                    </div>
                    <button type="submit" class="btn btn-submit" style="margin-top:10px;">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/logs.js"></script>
</body>
</html>