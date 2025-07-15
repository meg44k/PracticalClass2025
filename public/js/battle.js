window.addEventListener('DOMContentLoaded', () => {

  const timerElement = document.getElementById('timer');
  const typingArea = document.getElementById('type-words');
  const missCountElement = document.getElementById('miss-type');
  const scoreElement = document.getElementById('score');

  // --- 変数 ---
  const initialTime = 30 * 1000;
  let remainingTime = initialTime;
  let timerInterval;

  let targetWord; // Original romaji word (e.g., "konnichiwa")
  let currentJapaneseWord;
  let targetWordSegments = []; // Parsed romaji segments (e.g., ["ko", "n", "ni", "chi", "wa"])
  let currentIndex = 0; // Current segment index
  let typedBuffer = ''; // Characters typed for the current segment

  let missCount = 0;
  let typeCount = 0;
  let score = 0;
  let combo = 0;

  // --- Romaji Mapping for alternative spellings ---
  const romajiMap = {
    "a": ["a"], "i": ["i"], "u": ["u"], "e": ["e"], "o": ["o"],
    "ka": ["ka"], "ki": ["ki"], "ku": ["ku"], "ke": ["ke"], "ko": ["ko"],
    "sa": ["sa"], "shi": ["shi", "si"], "su": ["su"], "se": ["se"], "so": ["so"],
    "ta": ["ta"], "chi": ["chi", "ti"], "tsu": ["tsu", "tu"], "te": ["te"], "to": ["to"],
    "na": ["na"], "ni": ["ni"], "nu": ["nu"], "ne": ["ne"], "no": ["no"],
    "ha": ["ha"], "hi": ["hi"], "fu": ["fu", "hu"], "he": ["he"], "ho": ["ho"],
    "ma": ["ma"], "mi": ["mi"], "mu": ["mu"], "me": ["me"], "mo": ["mo"],
    "ya": ["ya"], "yu": ["yu"], "yo": ["yo"],
    "ra": ["ra"], "ri": ["ri"], "ru": ["ru"], "re": ["re"], "ro": ["ro"],
    "wa": ["wa"], "wo": ["wo"], "n": ["n", "nn"], // 'n' can be 'n' or 'nn'
    "ga": ["ga"], "gi": ["gi"], "gu": ["gu"], "ge": ["ge"], "go": ["go"],
    "za": ["za"], "ji": ["ji", "zi"], "zu": ["zu"], "ze": ["ze"], "zo": ["zo"],
    "da": ["da"], "dji": ["dji"], "dzu": ["dzu"], "de": ["de"], "do": ["do"],
    "ba": ["ba"], "bi": ["bi"], "bu": ["bu"], "be": ["be"], "bo": ["bo"],
    "pa": ["pa"], "pi": ["pi"], "pu": ["pu"], "pe": ["pe"], "po": ["po"],
    // Small Y-sounds
    "kya": ["kya"], "kyu": ["kyu"], "kyo": ["kyo"],
    "sha": ["sha", "sya"], "shu": ["shu", "syu"], "sho": ["sho", "syo"],
    "cha": ["cha", "tya"], "chu": ["chu", "tyu"], "cho": ["cho", "tyo"],
    "nya": ["nya"], "nyu": ["nyu"], "nyo": ["nyo"],
    "hya": ["hya"], "hyu": ["hyu"], "hyo": ["hyo"],
    "mya": ["mya"], "myu": ["myu"], "myo": ["myo"],
    "rya": ["rya"], "ryu": ["ryu"], "ryo": ["ryo"],
    "gya": ["gya"], "gyu": ["gyu"], "gyo": ["gyo"],
    "ja": ["ja", "zya"], "ju": ["ju", "zyu"], "jo": ["jo", "zyo"],
    "bya": ["bya"], "byu": ["byu"], "byo": ["byo"],
    "pya": ["pya"], "pyu": ["pyu"], "pyo": ["pyo"],
    // Small TSU/TU (xtu, ltu)
    "xtu": ["xtu", "ltu"],
    // Small A, I, U, E, O (xa, xi, xu, xe, xo)
    "xa": ["xa", "la"], "xi": ["xi", "li"], "xu": ["xu", "lu"], "xe": ["xe", "le"], "xo": ["xo", "lo"],
    // Other special cases
    "wi": ["wi"], "we": ["we"], "vu": ["vu"], "va": ["va"], "vi": ["vi"], "ve": ["ve"], "vo": ["vo"],
    "tsa": ["tsa"], "tsi": ["tsi"], "tse": ["tse"], "tso": ["tso"],
    "fa": ["fa"], "fi": ["fi"], "fe": ["fe"], "fo": ["fo"],
    "di": ["di"], "du": ["du"], "de": ["de"], "do": ["do"],
    "dya": ["dya"], "dyu": ["dyu"], "dyo": ["dyo"],
  };

  // Function to parse romaji string into segments based on romajiMap
  function parseRomaji(romajiString) {
    const segments = [];
    let i = 0;
    while (i < romajiString.length) {
      let foundMatch = false;
      // Try to match longest possible romaji sequence first
      // Max length of romaji is usually 4 (e.g., "dji")
      for (let len = 4; len >= 1; len--) {
        const sub = romajiString.substring(i, i + len);
        if (romajiMap[sub]) {
          segments.push(sub);
          i += len;
          foundMatch = true;
          break;
        }
      }
      if (!foundMatch) {
        // Fallback for single characters not in map (shouldn't happen with comprehensive map)
        segments.push(romajiString[i]);
        i++;
      }
    }
    return segments;
  }

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
      targetWordSegments = parseRomaji(targetWord); // Parse the romaji into segments
      currentIndex = 0; // Reset current index for segments
      typedBuffer = ''; // Reset typed buffer for new word
      updateTypingArea(); // Update the display
      document.getElementById('japanese-word').textContent = currentJapaneseWord;
    });
  }

  function updateTypingArea() {
    let displayedText = '';
    // Show the typed part of the current segment
    displayedText += typedBuffer;

    // Show the remaining part of the current segment
    if (currentIndex < targetWordSegments.length) {
      const currentSegment = targetWordSegments[currentIndex];
      displayedText += currentSegment.substring(typedBuffer.length);
    }

    // Show the rest of the word
    for (let i = currentIndex + 1; i < targetWordSegments.length; i++) {
      displayedText += targetWordSegments[i];
    }
    typingArea.innerHTML = `<span class="cursor">|</span>` + displayedText;
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
    typedBuffer = ''; // Reset typed buffer
    setNextWord();
  }

  window.addEventListener('keydown', (event) => {
    if (currentIndex >= targetWordSegments.length || !timerInterval) {
      return;
    }
    const key = event.key;

    if (key === 'Backspace') {
      if (typedBuffer.length > 0) {
        typedBuffer = typedBuffer.slice(0, -1);
        updateTypingArea();
      }
      return;
    }

    if (key.length === 1) { // Only process single character inputs
      typedBuffer += key;

      const currentExpectedSegment = targetWordSegments[currentIndex];
      const validForms = romajiMap[currentExpectedSegment] || [currentExpectedSegment]; // Fallback for single chars

      let isCorrectMatch = false;
      let matchedFormLength = 0;

      for (const form of validForms) {
        if (typedBuffer === form) {
          isCorrectMatch = true;
          matchedFormLength = form.length;
          break;
        }
      }

      if (isCorrectMatch) {
        combo++;
        score += 1 * combo;
        scoreElement.textContent = `スコア：${score}`;
        currentIndex++; // Move to next segment
        typeCount += matchedFormLength; // Increment typeCount by the length of the typed form
        typedBuffer = ''; // Reset buffer for next segment
        updateTypingArea(); // Update display

        if (currentIndex >= targetWordSegments.length) {
          setNextWord(); // Move to next word
        }
      } else {
        // Check if typedBuffer is a *prefix* of any valid form.
        let isPrefix = false;
        for (const form of validForms) {
          if (form.startsWith(typedBuffer)) {
            isPrefix = true;
            break;
          }
        }

        if (!isPrefix) {
          // It's a definite miss, reset buffer and combo
          combo = 0;
          missCount++;
          missCountElement.textContent = `ミス数：${missCount}`;
          typedBuffer = ''; // Reset buffer on miss
          updateTypingArea(); // Update display to show original segment
        }
        // If it's a prefix, do nothing, wait for more input.
        // updateTypingArea() is called to show the typed characters in the buffer.
        updateTypingArea();
      }
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