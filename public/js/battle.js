window.addEventListener('DOMContentLoaded', () => {

  const timerElement = document.getElementById('timer');
  const typingArea = document.getElementById('type-words');
  const missCountElement = document.getElementById('miss-type');

  // --- 変数 ---
  const initialTime = 0.18 * 60 * 1000;
  let remainingTime = initialTime;
  let timerInterval;

  const targetWord = 'tesuto';
  let currentIndex = 0;
  let missCount = 0;

  // --- 関数 ---
  function formatTime(time) {
    const minutes = Math.floor(time / (1000 * 60));
    const seconds = Math.floor((time / 1000) % 60);
    const formattedMinutes = minutes.toString().padStart(2, '0');
    const formattedSeconds = seconds.toString().padStart(2, '0');
    return `${formattedMinutes}:${formattedSeconds}`;
  }

  function startCountdown() {
    if (timerInterval) return;
    timerInterval = setInterval(() => {
      remainingTime -= 1000;
      timerElement.textContent = formatTime(remainingTime);
      if (remainingTime <= 0) {
        clearInterval(timerInterval);
        timerElement.textContent = "00:00";
        window.location.href = '/result';
      }
    }, 1000);
  }

  function resetGame() {
    clearInterval(timerInterval);
    timerInterval = null;
    remainingTime = initialTime;
    timerElement.textContent = formatTime(remainingTime);
    currentIndex = 0;
    missCount = 0;
    typingArea.textContent = targetWord;
    missCountElement.textContent = `ミス数：${missCount}`;
  }

  window.addEventListener('keydown', (event) => {
    if (currentIndex === targetWord.length || !timerInterval) {
      return;
    }
    const key = event.key;
    if (key === targetWord[currentIndex]) {
      currentIndex++;
      typingArea.textContent = targetWord.substring(currentIndex);
    } else if (key.length === 1) {
      missCount++;
      missCountElement.textContent = `ミス数：${missCount}`;
    }
  });

  resetGame();
  startCountdown();
});