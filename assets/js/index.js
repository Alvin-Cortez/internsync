// Live clock
function updateCurrentTime() {
    const now = new Date();
    let h = now.getHours();
    const m = now.getMinutes().toString().padStart(2, '0');
    const s = now.getSeconds().toString().padStart(2, '0');
    const ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    document.getElementById('currentTime').textContent = `${h}:${m}:${s} ${ampm}`;
}
setInterval(updateCurrentTime, 1000);
updateCurrentTime();

// Timer logic
let timer = 0, interval = null, clockedIn = false;
const timerEl = document.getElementById('activityTimer');
const statusEl = document.getElementById('activityStatus');
const clockInBtn = document.getElementById('clockInBtn');
const clockOutBtn = document.getElementById('clockOutBtn');
const descInput = document.getElementById('activityDesc');

function formatTimer(sec) {
    const h = Math.floor(sec / 3600).toString().padStart(2, '0');
    const m = Math.floor((sec % 3600) / 60).toString().padStart(2, '0');
    const s = (sec % 60).toString().padStart(2, '0');
    return `${h}:${m}:${s}`;
}

clockInBtn.onclick = function() {
    if (clockedIn) return;
    clockedIn = true;
    statusEl.textContent = 'Clocked in';
    timerEl.style.color = '#4f46e5';
    descInput.disabled = true;
    interval = setInterval(() => {
        timer++;
        timerEl.textContent = formatTimer(timer);
    }, 1000);
};
clockOutBtn.onclick = function() {
    if (!clockedIn) return;
    clockedIn = false;
    statusEl.textContent = 'Not clocked in';
    timerEl.style.color = '#4f46e5';
    descInput.disabled = false;
    clearInterval(interval);
    timer = 0;
    timerEl.textContent = '00:00:00';
};