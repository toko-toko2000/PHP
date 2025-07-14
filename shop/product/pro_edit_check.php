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
    <title>ろくまる農園 | 商品修正</title>
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
            margin-top: 100px;

            input[type="text"] {
                margin-top: 10px;
                padding: 30px;
                width: 700px;
                background-color: #e3adc1;
            }
        }

        form {

            margin: 100px 0 100px;
            text-align: right;

            input[type="button"] {

                margin: 0 50px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[type="button"]:hover {
                color: #ffffff;
                background-color: #009944;
            }

            input[type="submit"] {

                margin: 0 50px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[type="submit"]:hover {
                color: #ffffff;
                background-color: #009944;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        require_once('../common/common.php');

        $post = sanitize($_POST);
        $pro_code = $post['code'];
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name_old = $post['gazou_name_old'];
        $pro_gazou = $_FILES['gazou'];

        if ($pro_name == '') {
            print '<div class="info">';
            print '商品名が入力されていません。<br/>';
            print '</div>';
        } else {
            print '<div class="info">';
            print '商品名：';
            print $pro_name;
            print '</div>';
        }

        if (preg_match(' /\A[0-9]+\z/ ', $pro_price) == 0) {
            print '<div class="info">';
            print '価格をきちんと入力してください。<br/>';
            print '</div>';
        } else {
            print '<div class="info">';
            print '価格';
            print $pro_price;
            print '円';
            print '</div>';
        }
        if ($pro_gazou['size'] > 0) {
            if ($pro_gazou['size'] > 1000000) {
                print '<div class="info">';
                print '画像が大きすぎます。';
                print '</div>';
            } else {
                move_uploaded_file($pro_gazou['tmp_name'], './gazou/' . $pro_gazou['name']);
                print '<div class="info">';
                print '<img src="./gazou/' . $pro_gazou['name'] . '">';
                print '</div>';
            }
        }
        if ($pro_name == '' || preg_match(' /\A[0-9]+\z/ ', $pro_price) == 0 || $pro_gazou['size'] > 1000000) {
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        } else {
            print '<div class="info">';
            print '上記のように変更します。';
            print '</div>';
            print '<form method="post" action="pro_edit_done.php">';
            print '<input type="hidden" name="code" value="' . $pro_code . '">';
            print '<input type="hidden" name="name" value="' . $pro_name . '">';
            print '<input type="hidden" name="price" value="' . $pro_price . '">';
            print '<input type="hidden" name="gazou_name_old" value="' . $pro_gazou_name_old . '">';
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