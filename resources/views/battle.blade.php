<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>カウントダウンタイマー</title>
    @vite(['resources/css/app.css']) 
    <style>
        .cursor {
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body class="bg-blue-300 font-sans text-gray-700 flex justify-center items-center h-screen m-0">
    
<div class="relative w-[600px] h-[600px] rounded-2xl"> 
    
    <div id="timer" class="absolute top-[15px] left-[15px] px-4 py-2 rounded-2xl font-sans text-xl">00:10</div>

    <div id="miss-type" class="absolute top-[15px] right-[15px] px-4 py-2 rounded-2xl font-sans text-xl">ミス数：0</div>

    <div id="score" class="absolute top-[50px] right-[15px] px-4 py-2 rounded-2xl font-sans text-xl">スコア：0</div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-11/12 text-center text-2xl">
        <span id="type-words" class="block text-4xl pb-2 border-b border-black mb-1 s"></span>
        <span id="japanese-word" class="text-2xl text-gray-400"></span>
    </div>
</div>

<script src="{{ asset('js/battle.js') }}"></script>
</body>
</html>