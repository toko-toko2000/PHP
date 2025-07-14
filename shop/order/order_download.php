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
    <title>ろくまる農園 | 注文</title>
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

        .info {
            margin-top: 150px;
        }

        .date {
            padding: 40px;
            background-color: #bbdbf3;

            select {
                padding: 10px 20px;
                background-color: #ffffff;
            }
        }

        .button {
            margin: 150px 0;
            text-align: right;

            input[type="submit"] {
                margin: 0 20px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #0075c2 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[type="submit"]:hover {
                color: #ffffff;
                background-color: #0075c2;
            }
        }
    </style>
</head>

<body>
    <div class="inner">

        <?php
        require_once('../common/common.php');
        ?>

        <div class="info">
            ダウンロードしたい注文日を選んでください。<br /><br />
            <form method="post" action="order_download_done.php">
                <div class="date">
                    <?php pulldown_year(); ?>
                    年
                    <?php pulldown_month(); ?>
                    月
                    <?php pulldown_day(); ?>
                    日
                </div>
                <div class="button">
                    <input type="submit" value="ダウンロードへ">
                </div>
            </form>
        </div>
    </div>
</body>

</html>