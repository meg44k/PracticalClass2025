<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>楽市楽打メイン画面</title>
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
            position: absolute;
            top:50;
            right:50;

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
            gap: 50px;
        }
        .auth-links a {
        
            display: block;
            text-decoration: none;
            font-weight: bold;
            color:rgb(73, 65, 65);
            /*background-color: #ffffff*/
            padding: 3px 3px;
            border-radius: 50px;
        }
        .mypage-icon {
            position: absolute;
            top: 2px;
            right: 2px;
            font-size: 25px;
        }
        .setting-icon {
            position: absolute;
            top: 2px;
            right:60px;
            font-size: 25px;
        }
        .battle-menu {
            font-size: 80px;
        }
        .back-menu {
            position: absolute;
            top: 5px;
            left:5px;
            font-size:25px;
        }
        .auth-links a:hover {
            background-color:rgb(231, 136, 214);
        }
        
    </style>
</head>
<body>

    <header class="header">
        <div class="auth-links">
                <a href="mypage" class="custom-link mypage-icon">
                    <span class="icon">👤</span>
                </a>
                <a href="setting" class="custom-link setting-icon">
                    <span class="icon">⚙</span>
                </a>
                <a href="battle" class="custom-link battle-menu">
                    すたーと！！</a>
                <a href="/" class="custom-link back-menu">
                    <span class="icon">🔙</span>
                </a>
        </div>
    </header>

    </body>
</html>