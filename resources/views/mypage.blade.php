<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-blue-300">
    <div class="flex flex-col justify-center items-center min-h-screen">
        <h1 class="text-6xl text-gray-700 mb-8 mt-[-50px] custom-font">マイページ</h1>

        <div class="flex justify-center items-stretch space-x-8">
            <div class="bg-blue-100 p-6 rounded-lg shadow-lg w-[40rem]">
                <h2 class="text-2xl font-semibold mb-4">過去のゲームスコア</h2>
                @if ($gameScores->isEmpty())
                    <p>まだゲームスコアがありません。</p>
                @else
                    <div class="overflow-y-auto h-96">
                        <table class="min-w-full bg-blue-100">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300">順位</th>
                                    <th class="py-2 px-4 border-b border-gray-300">スコア</th>
                                    <th class="py-2 px-4 border-b border-gray-300">タイプ数</th>
                                    <th class="py-2 px-4 border-b border-gray-300">ミス数</th>
                                    <th class="py-2 px-4 border-b border-gray-300">日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gameScores as $index => $score)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $score->score }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $score->type_count }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $score->missed_type_count }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $score->created_at ? $score->created_at->format('Y/m/d H:i') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="bg-blue-100 p-6 rounded-lg shadow-lg w-[40rem]">
                <h2 class="text-2xl font-semibold mb-4">世界ランキング</h2>
                @if ($worldRanking->isEmpty())
                    <p>まだ誰もプレイしていません。</p>
                @else
                    <div class="overflow-y-auto h-96">
                        <table class="min-w-full bg-blue-100">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300">順位</th>
                                    <th class="py-2 px-4 border-b border-gray-300">プレイヤー</th>
                                    <th class="py-2 px-4 border-b border-gray-300">ハイスコア</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($worldRanking as $index => $rank)
                                    <tr class="{{ Auth::id() == $rank->id ? 'bg-blue-50' : '' }}">
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $rank->user->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $rank->high_score }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <a href="/main" class="custom-link back-menu">
            <span class="icon">🔙</span>
        </a>
    </div>
</body>
</html>