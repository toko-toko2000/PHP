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
    <title>ろくまる農園 | 商品参照</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
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

        h2 {
            margin-top: 100px;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40);
            text-align: center;
        }

        .info {
            margin-top: 100px;
        }

        .button {
            margin: 100px 0;
            text-align: right;

            input {
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #d70035 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input:hover {
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

            $pro_code = $_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou_name = $rec['gazou'];

            $dbh = null;
            if ($pro_gazou_name == '') {
                $disp_gazou = '';
            } else {
                $disp_gazou = '<img src="../product/gazou/' . $pro_gazou_name . '">';
            }
            print '<div class="link">';
            print '<a href="shop_cartin.php?procode=' . $pro_code . '">カートに入れる</a><br/><br/>';
            print '</div>';
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <h2>商品参照</h2>
        <br />
        <div class="info">
            商品コード：
            <?php print $pro_code; ?>
        </div>
        <div class="info">
            商品名：
            <?php print $pro_name; ?>
        </div>
        <div class="info">
            価格：
            <?php print $pro_price; ?>円
        </div>
        <div class="info">
            <?php print $disp_gazou; ?>
        </div>
        <form>
            <div class="button">
                <input type="button" onclick="history.back()" value="戻る">
            </div>
        </form>
    </div>
</body>

</html>