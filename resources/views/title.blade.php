<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>楽市楽打タイトル画面</title>
    <style>
        body {
            background-color:rgb(251, 170, 213);
            font-family: sans-serif;
            color: #333;

            margin: 0;

            display: flex;
            justify-content:center;
            align-items: center;

            height: 100vh;
        }
        .content-wrapper {
            text-align: center;
            background-color: white;
            padding: 50px 60px;
            border-radius: 10px;
        }
        .site-title {
            margin: 0; /* タイトルの下に余白 */
            margin-bottom: 30px;
            font-size: 40px;
        }
        .auth-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .auth-links a {
            display: block;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #000000;
            background-color: #ffffff;
            padding: 12px 20px;
            border-radius: 5px;
        }
        .auth-links a:hover {
            background-color: #28a745;
        }
    </style>
</head>
<body>

    <header class="header">
        <h1 class="site-title">楽市楽打</h1>
        <div class="auth-links">
                <a href="main">ログイン</a>
                <a href="register">アカウント登録</a>
        </div>
    </header>

    </body>
</html>