<!--Modal-->
    <div class="modal-background" id="modal-container">
        <div class="modal-container">
            <img class="modal-logo" src="assets/images/logo.png" alt="InternSync Logo">
            <span id="close-modal" onclick="closeModal()">&times;</span>
            <div class="buttons">
                <button type="button" class="btn-primary active" id="sign-in-btn" onclick="toggleSignIn()">Sign-In</button>
                <button type="button" class="btn-secondary" id="sign-up-btn" onclick="toggleSignUp()">Sign Up</button>
            </div>
            <form action="include/signin.php" method="POST">
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
            <form action="include/signup.php" method="POST">
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
            <!--<div id="username-error" style="font-size: 15px; color:hsl(0, 100.00%, 50.00%);">Username has taken.</div>-->
            <!--<div id="password-error" style="font-size: 15px; color:hsl(0, 100.00%, 50.00%);">
                        <ul>
                            <li>Password must be 8 characters long</li>
                            <li>Password includes 1 uppercase and 1 lowercase</li>
                            <li>Password includes 1 special character</li>
                        </ul>
                    </div>-->
            <!--<div id="username-error" style="font-size: 15px; color:hsl(0, 100.00%, 50.00%);">Password do not match.</div>-->
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="add-modal-background" id="add-activity-modal" style="display: none;">
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