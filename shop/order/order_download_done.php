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

        .button {
            margin-top: 400px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;

            a {
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

            a:hover {
                color: #ffffff;
                background-color: #0075c2;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        try {

            $year = $_POST['year'];
            $month = $_POST['month'];
            $day = $_POST['day'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT
                dat_sales.code,
                dat_sales.date,
                dat_sales.code_member,
                dat_sales.name AS dat_sales_name,
                dat_sales.name,
                dat_sales.email,
                dat_sales.postal1,
                dat_sales.postal2,
                dat_sales.address,
                dat_sales.tel,
                dat_sales_product.code_product,
                mst_product.name AS mst_product_name,
                mst_product.name,
                dat_sales_product.price,
                dat_sales_product.quantity
                FROM
                dat_sales,dat_sales_product,mst_product
                WHERE
                dat_sales.code=dat_sales_product.code_sales
                AND dat_sales_product.code_product=mst_product.code
                AND substr(dat_sales.date,1,4)=?
                AND substr(dat_sales.date,6,2)=?
                AND substr(dat_sales.date,9,2)=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $year;
            $data[] = $month;
            $data[] = $day;
            $stmt->execute($data);

            $dbh = null;

            $csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
            $csv .= "\n";
            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }
                $csv .= $rec['code'];
                $csv .= ',';
                $csv .= $rec['date'];
                $csv .= ',';
                $csv .= $rec['code_member'];
                $csv .= ',';
                $csv .= $rec['dat_sales_name'];
                $csv .= ',';
                $csv .= $rec['email'];
                $csv .= ',';
                $csv .= $rec['postal1'] . '-' . $rec['postal2'];
                $csv .= ',';
                $csv .= $rec['address'];
                $csv .= ',';
                $csv .= $rec['tel'];
                $csv .= ',';
                $csv .= $rec['code_product'];
                $csv .= ',';
                $csv .= $rec['mst_product_name'];
                $csv .= ',';
                $csv .= $rec['price'];
                $csv .= ',';
                $csv .= $rec['quantity'];
                $csv .= "\n";
            }
            //print nl2br($csv);
            $file = fopen('./chumon.csv', 'w');
            $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
            fputs($file, $csv);
            fclose($file);
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            print $e->getMessage();
            exit();
        }
        ?>
        <div class="button">

            <a href="chumon.csv" download>注文データのダウンロード</a><br />
            <br />
            <a href="order_download.php">日付選択へ</a><br />
            <br />
            <a href="../staff_login/staff_top.php">トップメニューへ</a><br />
        </div>
    </div>
</body>

</html>