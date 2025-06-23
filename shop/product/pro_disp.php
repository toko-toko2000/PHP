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
    <title>ろくまる農園 | 商品参照</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <style>
        body {
            color: #898989;
            background-color: #efefef;
            font-family: "Zen Kurenaido", sans-serif;
            letter-spacing: 0.05rem;
        }

        .inner {
            max-width: 1280px;
            width: 87%;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            margin: 100px auto 0;
            width: fit-content;
            color: #B2CBE4;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40)em;
        }

        .product {
            margin-top: 100px;
            color: #F5B2B2;
            background-color: #ffffff;
            border: solid #898989 1px;
        }

        .info {
            margin: 50px 30px;
            padding-bottom: 50px;
            border-bottom: solid #898989 1px;
        }

        .info:last-child {
            border-bottom: none;
        }

        form {
            margin: 80px 80px;
            text-align: center;

            input {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                color: #F5B2B2;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #898989 2px;
                transition: .3s ease-out;
            }

            input:hover {
                color: #efefef;
                background-color: #898989;
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
                $disp_gazou = '<img src="./gazou/' . $pro_gazou_name . '">';
            }
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <h2>商品参照</h2><br />
        <br />
        <div class="product">
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
        </div>
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </div>
</body>

</html>