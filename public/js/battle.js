window.addEventListener('DOMContentLoaded', () => {

  const timerElement = document.getElementById('timer');
  const typingArea = document.getElementById('type-words');
  const missCountElement = document.getElementById('miss-type');
  const scoreElement = document.getElementById('score');

  // --- 変数 ---
  const initialTime = 30 * 1000;
  let remainingTime = initialTime;
  let timerInterval;

  let targetWord;
  let currentJapaneseWord;
  let currentIndex = 0;
  let missCount = 0;
  let typeCount = 0;
  let score = 0;
  let combo = 0;


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
    timerInterval = setInterval(async () => {
      remainingTime -= 1000;
      timerElement.textContent = formatTime(remainingTime);
      if (remainingTime <= 0) {
        clearInterval(timerInterval);
        timerElement.textContent = "00:00";
        await saveGameResult();
        window.location.href = '/result';
      }
    }, 1000);
  }

  function getRandomWord() {
    return fetch('./words.json')
      .then(response => response.json())
      .then(data => {
        const randomIndex = Math.floor(Math.random() * data.length);
        return data[randomIndex];
      });
  }

  function setNextWord() {
    getRandomWord().then(word => {
      targetWord = word.romaji;
      currentJapaneseWord = word.japanese;
      typingArea.textContent = targetWord;
      document.getElementById('japanese-word').textContent = currentJapaneseWord;
      currentIndex = 0;
    });
  }

  function resetGame() {
    clearInterval(timerInterval);
    timerInterval = null;
    remainingTime = initialTime;
    timerElement.textContent = formatTime(remainingTime);
    missCount = 0;
    typeCount = 0;
    score = 0;
    combo = 0;
    missCountElement.textContent = `ミス数：${missCount}`;
    scoreElement.textContent = `スコア：${score}`;
    setNextWord();
  }

  window.addEventListener('keydown', (event) => {
    if (currentIndex === targetWord.length || !timerInterval) {
      return;
    }
    const key = event.key;
    if (key === targetWord[currentIndex]) {
      combo++;
      score += 1 * combo;
      scoreElement.textContent = `スコア：${score}`;
      currentIndex++;
      typeCount++;
      typingArea.textContent = targetWord.substring(currentIndex);
      if (currentIndex === targetWord.length) {
        setNextWord();
      }
    } else if (key.length === 1) {
      combo = 0;
      missCount++;
      missCountElement.textContent = `ミス数：${missCount}`;
    }
  });

  function saveGameResult() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    return fetch('/api/game-result', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        score: score,
        type_count: typeCount,
        missed_type_count: missCount
      })
    });
  }

  resetGame();
  startCountdown();
});