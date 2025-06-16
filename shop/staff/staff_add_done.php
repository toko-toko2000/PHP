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
    <title>ろくまる農園 | スタッフ追加</title>
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

        .info {
            margin-top: 100px;
            padding: 50px 30px;
            background-color: #ffffff;
            border: solid #6C3524 1px;
        }

        .link {
            margin-top: 80px;
            text-align: right;

            a {
                display: inline-block;
                padding: 20px 0;
                width: 200px;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #6C3524 2px;
                transition: .3s ease-out;
            }

            a:hover {
                border-color: #EA618E;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        require_once('../common/common.php');

        try {

            $post = sanitize($_POST);
            $staff_name = $post['name'];
            $staff_pass = $post['pass'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_name;
            $data[] = $staff_pass;
            $stmt->execute($data);

            $dbh = null;

            print '<div class=info>';
            print $staff_name;
            print 'さんを追加しました。<br/>';
            print '</div>';
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>
        <div class="link">
            <a href="staff_list.php">戻る</a>
        </div>
    </div>
</body>

</html>