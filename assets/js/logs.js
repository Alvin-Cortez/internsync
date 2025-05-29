document.addEventListener('DOMContentLoaded', function() {
    /* ACTIVE */
    const logsLink = document.getElementById('logs-link');
    if (logsLink) logsLink.classList.add('active');

    /* SIDEBAR TOGGLE */
    const hamburgerBtn = document.getElementById('hamburger-btn');
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('visible');
            document.querySelector('.main-content').classList.toggle('overlay');
        });
    }

    const closeBtn = document.getElementById('close-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('visible');
            document.querySelector('.main-content').classList.remove('overlay');
        });
    }

    /* MODAL FUNCTIONALITY */
    const modal = document.getElementById("modal-container");
    const closeModalBtn = document.getElementById("close-modal");

    window.openModal = function() {
        if (!modal) return;
        modal.style.display = "flex";
        document.querySelector('.main-content').classList.add('blurred');
        document.querySelector('.sidebar').classList.add('blurred');
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
            document.querySelector('.main-content').classList.remove('blurred');
            document.querySelector('.sidebar').classList.remove('blurred');
        });
    }

    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
            document.querySelector('.main-content').classList.remove('blurred');
            document.querySelector('.sidebar').classList.remove('blurred');
        }
    });

    /* SIGN UP / SIGN IN TOGGLE */
    const signUpBtn = document.getElementById("sign-up-btn");
    const signInBtn = document.getElementById("sign-in-btn");
    const signUpForm = document.getElementById("sign-up-form");
    const signInForm = document.getElementById("sign-in-form");

    window.toggleSignUp = function(){
        if (!signUpForm || !signInForm || !signUpBtn || !signInBtn) return;
        signUpForm.style.display = "flex";
        signInForm.style.display = "none";
        signUpBtn.classList.add("active");
        signInBtn.classList.remove("active");
    }

    window.toggleSignIn = function(){
        if (!signUpForm || !signInForm || !signUpBtn || !signInBtn) return;
        signInForm.style.display = "flex";
        signUpForm.style.display = "none";
        signInBtn.classList.add("active");
        signUpBtn.classList.remove("active");
    }

    /* ACCOUNT DROPDOWN */
    const profileDropdown = document.getElementById('profile-dropdown');
    const profileIcon = document.getElementById('profile-icon');

    function toggleProfileDropdown() {
        if (!profileDropdown) return;
        profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
    }

    if (profileIcon) {
        profileIcon.addEventListener('click', function(event) {
            event.stopPropagation();
            toggleProfileDropdown();
        });
    }

    window.addEventListener('click', (event) => {
        if (event.target !== profileDropdown && event.target !== profileIcon && profileDropdown) {
            profileDropdown.style.display = 'none';
        }
    });

    /* ADD ACTIVITY MODAL */
    window.openActivity = function(){
        const addActivityModal = document.getElementById("add-activity-modal");
        if (!addActivityModal) return;
        addActivityModal.style.display = "flex";
        document.querySelector('.main-content').classList.add('blurred');
        document.querySelector('.sidebar').classList.add('blurred');
    }

    window.closeAddActivityModal = function() {
        const addActivityModal = document.getElementById("add-activity-modal");
        if (!addActivityModal) return;
        addActivityModal.style.display = "none";
        document.querySelector('.main-content').classList.remove('blurred');
        document.querySelector('.sidebar').classList.remove('blurred');
    }
});