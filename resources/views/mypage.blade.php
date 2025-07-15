<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-blue-300">
    <div class="flex flex-col justify-center items-center min-h-screen">
        <h1 class="text-6xl text-gray-700 mb-8 mt-[-50px]">マイページ</h1>

        <div class="bg-blue-100 p-6 rounded-lg shadow-lg max-w-lg">
            <h2 class="text-2xl font-semibold mb-4">過去のゲームスコア</h2>
            @if ($gameScores->isEmpty())
                <p>まだゲームスコアがありません。</p>
            @else
                <table class="min-w-full bg-blue-100">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">スコア</th>
                            <th class="py-2 px-4 border-b">タイプ数</th>
                            <th class="py-2 px-4 border-b">ミス数</th>
                            <th class="py-2 px-4 border-b">日時</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gameScores as $score)
                            <tr>
                                <td class="py-2 px-4 border-b text-center">{{ $score->score }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $score->type_count }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $score->missed_type_count }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $score->created_at ? $score->created_at->format('Y/m/d H:i') : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>