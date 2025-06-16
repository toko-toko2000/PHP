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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&display=swap" rel="stylesheet">
    <style>
        body {
            color: #6C3524;
            background-color: #2CB4AD;
            font-family: "RocknRoll One", sans-serif;
            letter-spacing: 0.05rem;
        }

        .inner {
            max-width: 1280px;
            width: 87%;
            margin-left: auto;
            margin-right: auto;
        }

        .staff {
            margin-top: 100px;
            background-color: #ffffff;
            border: solid #6C3524 1px;
        }

        .info {
            margin: 50px 30px;
        }

        .info:first-child {
            padding-bottom: 50px;
            border-bottom: solid #6C3524 1px;
        }

        .staffname {
            margin-top: 100px;
            padding: 50px 30;
            color: #6c3524;
            background-color: #ffffff;
            font-weight: bold;
            border: solid #6c3524 2px;
            transition: .3s ease-out;
        }

        form {
            margin-top: 80px;
            text-align: center;

            input {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #6C3524 2px;
                transition: .3s ease-out;
            }

            input:hover {
                border-color: #EA618E;
            }
        }

        .button {
            margin-top: 80px;
            text-align: center;

            input {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #6C3524 2px;
                transition: .3s ease-out;
            }

            input:hover {
                border-color: #EA618E;
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
            print '<div class="staff">';
            print '<div class="info">';
            print 'スタッフ名が入力されていません';
            print '</div>';
        } else {
            print '<div class="staff">';
            print '<div class="info">';
            print 'スタッフ名：';
            print $staff_name;
            print '</div>';
        }
        if ($staff_pass == '') {
            print '<div class="info">';
            print 'パスワードが入力されていません。<br/>';
            print '</div>';
            print '</div>';
        }
        if ($staff_pass != $staff_pass2) {
            print '<div class="info">';
            print 'パスワードが一致しません。<br/>';
            print '</div>';
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
</body>

</html>