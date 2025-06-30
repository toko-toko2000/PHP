<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <style>
        .info {
            margin-top: 100px;
            padding: 50px 30px;
            position: relative;
            color: #000000;
            background-color: #ffffff;
            border: solid #ee7800 5px;
        }

        .link {
            text-align: right;

            a {
                margin: 80px 0;
                padding: 20px 40px;
                display: inline-block;
                color: #000000;
                background-color: #ffffff;
                font-weight: bold;
                text-decoration: none;
                border: solid #ee7800 2px;
                border-radius: 50px;
                transition: .3s ease-out;

                p {
                    position: relative;
                }
            }

            p::before,
            p::after {
                position: absolute;
                content: "";
                width: 0;
                height: 0;
                transition: .5s ease-out;
            }

            p::before {
                left: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            p::after {
                right: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            p:hover::before,
            p:hover::after {
                width: 50px;
                height: 0;
                border-bottom-color: #ffffff;
            }

            a:hover {
                color: #ffffff;
                background-color: #ee7800;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <div class="info">
            ログアウトしました。
        </div>
        <div class="link">
            <a href="../staff_login/staff_login.html">
                <p>ログイン画面へ</p>
            </a>
        </div>
    </div>
</body>

</html>