<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    print '<div class="login">';
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a>';
    print '</div>';
} else {
    print '<div class="login">';
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様 ';
    print '<a href="member_logout.php">ログアウト</a><br/>';
    print '<br/>';
    print '</div>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | カートに追加</title>
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

        .info {
            margin-top: 100px;
            padding: 50px 30px;
            position: relative;
            color: #000000;
        }

        .link {
            text-align: right;

            a {
                margin: 80px 0;
                padding: 40px;
                display: inline-block;
                width: 300px;
                color: #000000;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #7f1184 2px;
                border-radius: 50px;
                transition: .3s ease-out;
            }

            a:hover {
                color: #ffffff;
                background-color: #7f1184;
            }
        }
    </style>
</head>

<body>
    <div class="inner">

        <?php

        try {
            $pro_code = $_GET['procode'];

            if (isset($_SESSION['cart']) == true) {
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                if (in_array($pro_code, $cart) == true) {
                    print '<div class="info">';
                    print 'その商品はすでにカートに入っています。';
                    print '</div>';
                    print '<div class="link">';
                    print '<a href="shop_list.php">商品一覧に戻る</a>';
                    print '</div>';
                    exit();
                }
            }
            $cart[] = $pro_code;
            $kazu[] = 1;
            $_SESSION['cart'] = $cart;
            $_SESSION['kazu'] = $kazu;
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <div class="info">
            カートに追加しました。<br />
        </div>
        <br />
        <div class="link">
            <a href="shop_list.php">商品一欄に戻る</a>
        </div>
    </div>
</body>

</html>