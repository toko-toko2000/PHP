<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    print '<div class="login">';
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a>';
    print '</div>';
} else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様 ';
    print 'ログイン中';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | 商品一覧</title>
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

        .login {
            a {
                display: inline-block;
                transition: .3s ease-out;
            }

            a:hover {
                color: #d70035;
                transform: scale(1.1);
            }
        }

        h1 {
            margin-top: 100px;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40);
            text-align: center;
        }

        .info a {
            margin-top: 50px;
            display: inline-block;
            position: relative;
        }

        .info:first-of-type {
            margin-top: 100px;
        }

        .info a::before {
            margin-bottom: -5px;
            position: absolute;
            content: "";
            width: 100%;
            height: 0;
            bottom: 0;
            left: 0;
            border-bottom: solid transparent 2px;
            border-left: solid transparent 2px;
            transform: scaleX(0);
            transition: .3s ease-out;
        }

        .info a:hover {
            color: #d70035;
        }

        .info a:hover::before {
            border-color: #d70035;
            transform: scaleX(1);
        }

        .button {
            margin-top: 100px;

            input[name="disp"] {
                margin: 0 10px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #d70035 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[name="disp"]:hover {
                color: #ffffff;
                background-color: #d70035;
            }
        }

        .link {
            margin: 150px 0 100px;
            text-align: right;

            .link1 {
                margin: 0 30px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                color: #000000;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                text-decoration: none;
                border: solid #7f1184 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .link1:hover {
                color: #ffffff;
                background-color: #7f1184;
            }

            .link2 {
                margin: 0 30px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                color: #000000;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                text-decoration: none;
                border: solid #d70035 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            .link2:hover {
                color: #ffffff;
                background-color: #d70035;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        try {

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            print '<h1>商品一覧</h1>';

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }
                print '<div class="info">';
                print '<a href="shop_product.php?procode=' . $rec['code'] . '">';
                print $rec['name'] . '---';
                print $rec['price'] . '円';
                print '</a>';
                print '</div>';
            }
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        print '<br/>';
        print '<div class="link">';
        print '<a class="link1" href="shop_cartlook.php">カートを見る</a>';
        print '<a class="link2" href="member_logout.php">ログアウト</a>';
        print '</div>';
        ?>
    </div>
</body>

</html>