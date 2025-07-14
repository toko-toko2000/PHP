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
    <title>ろくまる農園 | スッタフ修正</title>
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
                border: solid #E95388 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[type="button"]:hover {
                color: #ffffff;
                background-color: #E95388;
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
                border: solid #E95388 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[type="submit"]:hover {
                color: #ffffff;
                background-color: #E95388;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        require_once('../common/common.php');

        $post = sanitize($_POST);
        $staff_code = $post['code'];
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];

        if ($staff_name == '') {
            print '<div class="info">';
            print 'スタッフ名が入力されていません<br/>';
            print '</div>';
        } else {
            print '<div class="info">';
            print 'スタッフ名：';
            print $staff_name;
            print '<br/>';
            print '</div>';
        }
        if ($staff_pass == '') {
            print '<div class="info">';
            print 'パスワードが入力されていません。<br/>';
            print '</div>';
        }
        if ($staff_pass != $staff_pass2) {
            print '<div class="info">';
            print 'パスワードが一致しません。<br/>';
            print '</div>';
        }

        if ($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2) {
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        } else {
            $staff_pass = md5($staff_pass);
            print '<form method="post" action="staff_edit_done.php">';
            print '<input type="hidden" name="code" value="' . $staff_code . '">';
            print '<input type="hidden" name="name" value="' . $staff_name . '">';
            print '<input type="hidden" name="pass" value="' . $staff_pass . '">';
            print '<br/>';
            print '<div class=button>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK">';
            print '</div>';
            print '</form>';
        }
        ?>

    </div>

</html>