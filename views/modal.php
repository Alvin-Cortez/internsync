        <!-- Profile Modal -->
        <div class="modal-overlay" id="profileModalOverlay" style="display:none;">
            <div class="profile-modal">
                <div class="profile-modal-sidebar">
                    <div class="profile-user-info">
                        <div class="profile-user-name"><?= $userProfile['firstName'] . ' ' . $userProfile['lastName']?></div>
                        <div class="profile-user-email"><?= $userProfile['email'] ?></div>
                    </div>
                    <div class="profile-modal-nav">
                        <button class="profile-nav-btn active" data-section="profile"><span class="profile-nav-icon"><i class="fa-regular fa-user"></i></span> Profile</button>
                        <button class="profile-nav-btn" data-section="password"><span class="profile-nav-icon"><i class="fa-solid fa-lock"></i></span> Password</button>
                        <button class="profile-nav-btn" data-section="email"><span class="profile-nav-icon"><i class="fa-regular fa-envelope"></i></span> Email</button>
                    </div>
                </div>
                <div class="profile-modal-content">
                    <!-- Profile Section -->
                    <div class="profile-section" id="profileSection">
                        <h2>Profile Settings</h2>
                        <form id="profileForm">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" value="<?= $userProfile['firstName'] ?>">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" value="<?= $userProfile['lastName'] ?>">
                            <button type="submit" class="profile-save-btn">Save Changes</button>
                        </form>
                    </div>  
                    <!-- Password Section -->
                    <div class="profile-section" id="passwordSection" style="display:none;">
                        <h2>Change Password</h2>
                        <form id="passwordForm">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" name="currentPassword" id="currentPassword">
                            <label for="newPassword">New Password</label>
                            <input type="password" name="newPassword" id="newPassword">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword">
                            <button type="submit" class="profile-save-btn">Update Password</button>
                        </form>
                    </div>
                    <!-- Email Section -->
                    <div class="profile-section" id="emailSection" style="display:none;">
                        <h2>Change Email</h2>
                        <form id="emailForm">
                            <label for="currentEmail">Current Email</label>
                            <input type="email" id="currentEmail" value="<?= $userProfile['email'] ?>" readonly>
                            <label for="newEmail">New Email</label>
                            <input type="email" id="newEmail">
                            <label for="emailPassword">Password</label>
                            <input type="password" id="emailPassword">
                            <button type="button" class="profile-save-btn">Update Email</button>
                        </form>
                    </div>
                </div>
                <button class="modal-close-btn" id="closeProfileModal">&times;</button>
            </div>
        </div>

        <!--Add Activity Modal-->
    <div class="modal-overlay" id="addActivityModal" style="display:none;">
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
    <div class="modal-overlay" id="editActivityModal" style="display:none;">
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

    <!-- Delete Modal -->
    <div id="modal-delete" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2 class="modal-delete-head">Delete User</h2>
            <p>Are you sure you want to delete this user?</p>
            <div class="modal-actions">
            <button id="confirm-delete" class="modal-btn danger">Delete</button>
            <button type="button" class="modal-btn">Cancel</button>
            </div>
        </div>
    </div>