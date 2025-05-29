/* ACTIVE */
document.getElementById('dashboard-link').classList.add('active');

/* SIDEBAR TOGGLE */
const hamburgerBtn = document.getElementById('hamburger-btn');
hamburgerBtn.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('visible');
    document.querySelector('.main-content').classList.toggle('overlay');
});

const closeBtn = document.getElementById('close-btn');
closeBtn.addEventListener('click', function () {
    document.getElementById('sidebar').classList.remove('visible');
    document.querySelector('.main-content').classList.remove('overlay');
});

/* MODAL FUNCTIONALITY */
const modal = document.getElementById("modal-container");

function openModal() {
    modal.style.display = "flex";
    document.querySelector('.main-content').classList.add('blurred');
    document.querySelector('.sidebar').classList.add('blurred');
}

function closeModal(){
    modal.style.display = "none";
    document.querySelector('.main-content').classList.remove('blurred');
    document.querySelector('.sidebar').classList.remove('blurred');
}

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
        document.querySelector('.main-content').classList.remove('blurred');
        document.querySelector('.sidebar').classList.remove('blurred');
    }
})

/* SIGN UP / SIGN IN TOGGLE */
const signUpBtn = document.getElementById("sign-up-btn");
const signInBtn = document.getElementById("sign-in-btn");
const signUpForm = document.getElementById("sign-up-form");
const signInForm = document.getElementById("sign-in-form");

function toggleSignUp(){
    signUpForm.style.display = "flex"
    signInForm.style.display = "none";
    signUpBtn.classList.add("active");
    signInBtn.classList.remove("active");
}

function toggleSignIn(){
    signInForm.style.display = "flex";
    signUpForm.style.display = "none";
    signInBtn.classList.add("active");
    signUpBtn.classList.remove("active");
}

/* ACCOUNT DROPDOWN */

const profileDropdown = document.getElementById('profile-dropdown');
const profileIcon = document.getElementById('profile-icon');

function toggleProfileDropdown() {
    profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
}

window.addEventListener('click', (event) => {
    if (event.target !== profileDropdown && event.target !== profileIcon) {
        profileDropdown.style.display = 'none';
    }
});