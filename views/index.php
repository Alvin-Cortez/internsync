<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>InternSync</title>
</head>
<body>
    <div class="container">
        <div class="form-left">
            <div class="logo-row">
                <svg width="35" height="35" viewBox="0 0 28 28" fill="none">
                    <circle cx="14" cy="14" r="12" fill="#ffffff"/>
                    <rect x="13" y="7" width="2" height="8" rx="1" fill="#4f46e5"/>
                    <rect x="14" y="14" width="6" height="2" rx="1" fill="#4f46e5" transform="rotate(45 14 14)"/>
                </svg>
                <h1 class="logo-text">InternSync</h1>
            </div>
            <h2 class="subtitle">Track your time efficiently. Manage your internship hours with ease.</h2>
            <div class="info-container">
                <span class="info-title">InternSync helps you:</span>
                <ul>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none">
                            <circle cx="14" cy="14" r="14" fill="#fff" fill-opacity="0.2"/>
                            <path d="M9 15L13 19L19 11" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Log your daily activities
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none">
                            <circle cx="14" cy="14" r="14" fill="#fff" fill-opacity="0.2"/>
                            <path d="M9 15L13 19L19 11" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Track your hours automatically
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none">
                            <circle cx="14" cy="14" r="14" fill="#fff" fill-opacity="0.2"/>
                            <path d="M9 15L13 19L19 11" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Generate reports for your supervisor
                    </li>
                </ul>
            </div>
        </div>
        <div class="form-right" >
            <!-- Login Form -->
            <form class="signin-form" id="loginForm" action="?page=signin" method="POST">
                <h2>Log in to your account</h2>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="your@email.com">
                <label for="password">Password</label>
                <input type="password" id="password" name="pass" placeholder="••••••••">
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="signin-btn">Log in</button>
                <div class="register-link">
                    Don't have an account? <a href="#" id="showRegister">Register</a>
                </div>
            </form>
            <!-- Register Form -->
            <form class="signup-form" id="registerForm" style="display:none;" action="?page=signup" method="POST">
                <h2>Create your account</h2>
                <div class="register-names-row">
                    <div>
                        <label for="firstName">First Name<span class="required">*</span></label>
                        <input type="text" id="firstName" name="firstName" placeholder="John">
                    </div>
                    <div>
                        <label for="lastName">Last Name<span class="required">*</span></label>
                        <input type="text" id="lastName" name="lastName" placeholder="Doe">
                    </div>
                </div>
                <label for="regEmail">Email<span class="required">*</span></label>
                <input type="email" id="regEmail" name="regEmail" placeholder="your@email.com">
                <label for="requiredHours">Required Hours<span class="required">*</span></label>
                <input type="number" id="requiredHours" name="requiredHours" placeholder="e.g. 120">
                <span style="font-size:0.95rem;color:#64748b;margin-bottom:8px;">Total hours required for your internship</span>
                <label for="regPassword">Password<span class="required">*</span></label>
                <input type="password" id="regPassword" name="regPassword" placeholder="••••••••">
                <label for="confirmPassword">Confirm Password<span class="required">*</span></label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••">
                <button type="submit" class="signup-btn" style="margin-top:16px;">Register</button>
                <div class="register-link">
                    Already have an account? <a href="dashboard.php" id="showLogin">Log in</a>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/index.js"></script>
</body>
</html>