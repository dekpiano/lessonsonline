let end = new Date().getTime() + (60 * 1000); // 10 seconds from now
const circle = document.querySelector('circle');
const number = document.getElementById('number');
const circumference = 2 * Math.PI * circle.getAttribute('r');

circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = `${circumference}`;

function updateCountdown() {
  const now = new Date().getTime();
  const distance = end - now;
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Calculate the offset for the circular progress
  const percent = (((distance / 1000)) / 60) * circumference;
  circle.style.strokeDashoffset = circumference - percent;

  // Update the timer display
  number.textContent = `0:${seconds < 10 ? '0' : ''}${seconds}`;

  // Automatically restart the countdown when it reaches 0
  if (distance < 0) {
    resetCountdown();
  }
}

function resetCountdown() {
  end = new Date().getTime() + (60 * 1000); // Reset end time to 10 seconds from now
  circle.style.strokeDashoffset = `${circumference}`; // Reset the circle's stroke dashoffset
  updateCountdown(); // Update the countdown immediately to avoid delay
}

updateCountdown(); // Initialize the countdown
const interval = setInterval(updateCountdown, 1000);