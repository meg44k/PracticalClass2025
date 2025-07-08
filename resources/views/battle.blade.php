<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>カウントダウンタイマー</title>
    <link rel="stylesheet" href="{{ asset('css/battle.css') }}"> </head>
<body>
    
<div class="battle-page"> 
    
    <div id="timer">00:10</div>

    <div id="miss-type">ミス数：0</div>

    <div class="words">
        <span id="type-words" class="words-rubi"></span>
        <span class="words-main">テスト</span>
    </div>
</div>

<script src="{{ asset('js/battle.js') }}"></script>
</body>
</html>