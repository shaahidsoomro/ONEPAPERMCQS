// User Quiz Interface Enhancements - MCQS Maker
document.addEventListener('DOMContentLoaded', function () {
  const quizForm = document.querySelector('form');
  if (quizForm) {
    const radios = quizForm.querySelectorAll('input[type="radio"]');
    if (radios.length) {
      radios[0].focus(); // Focus first radio for accessibility
    }
  }

  // Optional timer (uncomment below to activate basic countdown)
  /*
  let timerSeconds = 300; // 5 minutes
  const timerDisplay = document.createElement('div');
  timerDisplay.style.fontWeight = 'bold';
  timerDisplay.style.marginBottom = '15px';
  document.querySelector('.mcqs-wrapper')?.prepend(timerDisplay);

  const interval = setInterval(() => {
    const minutes = Math.floor(timerSeconds / 60);
    const seconds = timerSeconds % 60;
    timerDisplay.textContent = `Time left: ${minutes}:${seconds.toString().padStart(2, '0')}`;
    timerSeconds--;
    if (timerSeconds < 0) {
      clearInterval(interval);
      alert('Time is up! Submitting your quiz.');
      document.querySelector('form').submit();
    }
  }, 1000);
  */
});
