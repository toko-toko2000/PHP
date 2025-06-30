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
    <title>ろくまる農園 | 商品追加</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <style>
        body {
            color: #898989;
            background-color: #EFEFEF;
            font-family: "Zen Kurenaido", sans-serif;
            letter-spacing: 0.05rem;
        }

        .inner {
            max-width: 1280px;
            width: 87%;
            margin-left: auto;
            margin-right: auto;
        }

        .product {
            margin-top: 80px;
            color: #F5B2B2;
            background-color: #ffffff;
            border: solid #898989 1px;
        }

        .info {
            margin: 50px 30px;
            padding-bottom: 50px;
            border-bottom: solid #898989 1px;
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        require_once('../common/common.php');

        $post = sanitize($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou = $_FILES['gazou'];

        if ($pro_name == '') {
            print '<div class="product">';
            print '<div class="info">';
            print '商品名が入力されていません。<br/>';
        } else {
            print '商品名：';
            print $pro_name;
            print '</div>';
        }

        if (preg_match(' /\A[0-9]+\z/ ', $pro_price) == 0) {
            print '<div class="info">';
            print '価格をきちんと入力してください。<br/>';
        } else {
            print '価格';
            print $pro_price;
            print '円<br/>';
            print '</div>';
        }
        if ($pro_gazou['size'] > 0) {
            if ($pro_gazou['size'] > 1000000) {
                print '<div class="info">';
                print '画像が大きすぎます。';
            } else {
                move_uploaded_file($pro_gazou['tmp_name'], './gazou/' . $pro_gazou['name']);
                print '<img src="./gazou/' . $pro_gazou['name'] . '">';
                print '</div>';
                print '</div>';
            }
        }
        if ($pro_name == '' || preg_match(' /\A[0-9]+\z/ ', $pro_price) == 0 || $pro_gazou['size'] > 1000000) {
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        } else {
            print '上記の商品を追加します。';
            print '<form method="post" action="pro_add_done.php">';
            print '<input type="hidden" name="name" value="' . $pro_name . '">';
            print '<input type="hidden" name="price" value="' . $pro_price . '">';
            print '<input type="hidden" name="gazou_name" value="' . $pro_gazou['name'] . '">';
            print '<br/>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK">';
            print '</form>';
        }
        ?>
    </div>
</body>

</html>