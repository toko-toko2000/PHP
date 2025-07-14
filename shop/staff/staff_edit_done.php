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
    <title>ろくまる農園 | スタッフ修正</title>
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

        h1 {
            margin-top: 100px;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40);
            text-align: center;
        }

        .info {
            margin-top: 100px;

            p {
                font-size: 20px;
                line-height: (32/20);
            }

            input {
                margin-top: 10px;
                padding: 30px;
                width: 700px;
                background-color: #e3adc1;
            }
        }

        .button {
            margin: 100px 0 100px;
            text-align: right;

            a {
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

            a:hover {
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

        try {

            $post = sanitize($_POST);
            $staff_code = $post['code'];
            $staff_name = $post['name'];
            $staff_pass = $post['pass'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_name;
            $data[] = $staff_pass;
            $data[] = $staff_code;
            $stmt->execute($data);

            $dbh = null;
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>
        <div class="info">
            修正しました。<br />
        </div>
        <br />
        <div class="button">
            <a href="staff_list.php">戻る</a>
        </div>
    </div>
</body>

</html>