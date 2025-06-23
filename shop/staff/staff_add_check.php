<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
    print 'ログインされていません。>br/>';
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
    <title>ろくまる農園 | スッタフ追加</title>
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

        .info {
            margin-top: 100px;
            padding: 50px 30px;
            color: #F5B2B2;
            background-color: #ffffff;
            border: solid #898989 1px;
        }

        form {
            margin-top: 80px;
            text-align: center;

            input[type="button"] {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                color: #F5B2B2;
                background-color: #ffffff;
                font-weight: bold;
                border: solid #898989 2px;
                transition: .3s ease-out;
            }

            input[type="button"]:hover {
                color: #efefef;
                background-color: #898989;
            }

            input[type="submit"] {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                color: #F5B2B2;
                background-color: #ffffff;
                font-weight: bold;
                border: solid #898989 2px;
                transition: .3s ease-out;
            }

            input[type="submit"]:hover {
                color: #efefef;
                background-color: #898989;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        require_once('../common/common.php');

        $post = sanitize($_POST);
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $staff_pass2 = $post['pass2'];

        if ($staff_name == '') {
            print '<div class=info>';
            print 'スタッフ名が入力されていません。<br/>';
            print '</div>';
        } else {
            print '<div class=info>';
            print 'スタッフ名：';
            print $staff_name;
            print '<br/>';
            print '</div>';
        }
        if ($staff_pass == '') {
            print '<div class=info>';
            print 'パスワードが入力されていません。<br/>';
            print '</div>';
        }
        if ($staff_pass != $staff_pass2) {
            print 'パスワードが一致しません。<br/>';
        }

        if ($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2) {
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        } else {
            $staff_pass = md5($staff_pass);
            print '<form method="post" action="staff_add_done.php">';
            print '<input type="hidden" name="name" value="' . $staff_name . '">';
            print '<input type="hidden" name="pass" value="' . $staff_pass . '">';
            print '<br/>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK">';
            print '</form>';
        }
        ?>
    </div>
</body>

</html>