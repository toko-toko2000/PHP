<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    print 'ログインされていません。<br/>';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | ご購入の確認</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&family=Zen+Maru+Gothic&family=Zen+Old+Mincho&display=swap"
        rel="stylesheet">
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
            margin-top: 100px;
            line-height: 1.6;
        }

        .info2 {
            margin-top: 50px;
            line-height: 1.6;
        }

        .link {
            margin: 100px 0;
            text-align: right;

            a {
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #7f1184 3px;
                border-radius: 60px;
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
            require_once('../common/common.php');

            $post = sanitize($_POST);

            $onamae = $post['onamae'];
            $email = $post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $tel = $post['tel'];

            print '<div class="info">';
            print $onamae . '様<br/>';
            print 'ご注文ありがとうございました。<br/>';
            print $email . 'にメールを送りましたのでご確認ください。<br/>';
            print '</div>';
            print '<div class="info2">';
            print '商品は以下の住所に発送させていただきます。<br/>';
            print $postal1 . '-' . $postal2 . '<br/>';
            print $address . '<br/>';
            print $tel . '<br/>';
            print '</div>';

            $honbun = '';
            $honbun .= $onamae . "様\n\nこの度はご注文ありがとうございました。\n";
            $honbun .= "\n";
            $honbun .= "ご注文商品\n";
            $honbun .= "--------------------\n";

            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            $max = count($cart);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            for ($i = 0; $i < $max; $i++) {
                $sql = 'SELECT name,price FROM mst_product WHERE code=?';
                $stmt = $dbh->prepare($sql);
                $data[0] = $cart[$i];
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                $name = $rec['name'];
                $price = $rec['price'];
                $kakaku[] = $price;
                $suryo = $kazu[$i];
                $shokei = $price * $suryo;

                $honbun .= $name . '';
                $honbun .= $price . '円x';
                $honbun .= $suryo . '個=';
                $honbun .= $shokei . "円\n";
            }

            $sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $lastmembercode = $_SESSION['member_code'];

            $sql = 'INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $lastmembercode;
            $data[] = $onamae;
            $data[] = $email;
            $data[] = $postal1;
            $data[] = $postal2;
            $data[] = $address;
            $data[] = $tel;
            $stmt->execute($data);


            $sql = 'SELECT LAST_INSERT_ID()';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastcode = $rec['LAST_INSERT_ID()'];

            for ($i = 0; $i < $max; $i++) {
                $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $data = array();
                $data[] = $lastcode;
                $data[] = $cart[$i];
                $data[] = $kakaku[$i];
                $data[] = $kazu[$i];
                $stmt->execute($data);
            }

            $sql = 'UNLOCK TABLES';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            $honbun .= "⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎\n";
            $honbun .= "　〜安心野菜のろくまる農園〜\n";
            $honbun .= "\n";
            $honbun .= "〇〇県六丸郡六丸村123-4\n";
            $honbun .= "電話 090-6060-xxxx\n";
            $honbun .= "メール info@rokumarunouen.co.jp\n";
            $honbun .= "⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎⬜︎\n";
            // print '<br/>';
            // print nl2br($honbun);

            $title = 'ご注文ありがとうございます。';
            $header = 'From:info@rokumarunouen.co.jp';
            $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail($email, $title, $honbun, $header);

            // print '<br/>';
            // print nl2br($honbun);

            $title = 'お客様からご注文がありました。';
            $header = 'From:' . $email;
            $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をおかけしております。';
            print $e->getMessage();
            exit();
        }
        ?>

        <br />
        <div class="link">
            <a href="shop_list.php">商品画面へ</a>
        </div>
    </div>
</body>

</html>