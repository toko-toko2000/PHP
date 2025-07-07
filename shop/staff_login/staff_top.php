<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
    print 'ログインされていません。<br/>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br/>';
    print '<br/>';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | トップ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&family=Zen+Maru+Gothic&family=Zen+Old+Mincho&display=swap" rel="stylesheet">
    <style>
        body {
            color: #000000;
            background-color: #ffffff;
            font-family: "Noto Sans JP", sans-serif;
            letter-spacing: (5/1000)rem;
        }

        .inner {
            width: 90%;
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            margin-top: 150px;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40);
            text-align: center;
        }

        .button {
            margin-top: 150px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;

            .button1 {
                margin: 0 10px;
                padding: 40px 0;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #e95388 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .button1:hover {
                color: #ffffff;
                background-color: #e95388;
            }

            .button2 {
                margin: 0 10px;
                padding: 40px 0;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .button2:hover {
                color: #ffffff;
                background-color: #009944;
            }

            .button3 {
                margin: 0 10px;
                padding: 40px 0;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #0075c2 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .button3:hover {
                color: #ffffff;
                background-color: #0075c2;
            }

            .button4 {
                margin: 0 10px;
                padding: 40px 0;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #EE7800 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .button4:hover {
                color: #ffffff;
                background-color: #EE7800;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <h1>ショップ管理トップメニュー</h1>
        <div class="button">
            <a class="button1" href="../staff/staff_list.php">
                <p>スタッフ管理</p>
            </a>
            <a class="button2" href="../product/pro_list.php">
                <p>商品管理</p>
            </a>
            <a class="button3" href="../order/order_download.php">
                <p>注文ダウンロード</p>
            </a>
            <a class="button4" href="staff_logout.php">
                <p>ログアウト</p>
            </a>
        </div>
    </div>
</body>

</html>