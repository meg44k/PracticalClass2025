// HTML要素を取得
const timerElement = document.getElementById('timer');
const resetBtn = document.getElementById('resetBtn');
const typingArea = document.getElementById('type-words');
// ----- 変更点：変数の準備 -----
const initialTime = 0.18 * 60 * 1000; // 5分をミリ秒で設定
let remainingTime = initialTime; // 残り時間
let timerInterval;  // setIntervalのID

// ----- 変更点：時間を分:秒にフォーマットする関数 -----
function formatTime(time) {
  const minutes = Math.floor(time / (1000 * 60));
  const seconds = Math.floor((time / 1000) % 60);

  // ゼロ埋め
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
      alert("time up !!");
    }
  }, 1000);
}


// リセットボタンの処理
resetBtn.addEventListener('click', () => {
  clearInterval(timerInterval); // 時間の更新を停止
  timerInterval = null;
  remainingTime = initialTime; // 残り時間を初期値に戻す
  timerElement.textContent = formatTime(remainingTime);
});

//初期状態更新
timerElement.textContent = formatTime(remainingTime);

window.addEventListener('DOMContentLoaded', (event) => {
  startCountdown();
});

////////////////////////////////////////////////////////

window.addEventListener('keydown', (event) => {

  const key = event.key;

  if (key == 'Backspace') {
    typingArea.textContent = typingArea.textContent.slice(0,-1);
  } else if (key.length === 1) {
    typingArea.textContent += key;
  }
});
