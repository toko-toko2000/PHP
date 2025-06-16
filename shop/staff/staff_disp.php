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
    <title>ろくまる農園 | スタッフ参照</title>
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

        h2 {
            margin: 100px auto 0;
            width: fit-content;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40)em;
            border-bottom: dotted #EA618E 5px;
        }

        .staff {
            margin-top: 100px;
            background-color: #ffffff;
            border: solid #6C3524 1px;

            .info {
                margin: 50px 30px;
            }

            .info:first-child {
                padding-bottom: 50px;
                border-bottom: solid #6C3524 1px;
            }
        }

        form {
            text-align: right;

            input {
                margin: 80px 0;
                padding: 20px 0;
                width: 200px;
                font-weight: bold;
                background-color: #ffffff;
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

        try {

            $staff_code = $_GET['staffcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name FROM mst_staff WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];

            $dbh = null;
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <h2>スタッフ参照</h2><br />
        <br />
        <div class="staff">
            <div class="info">
                スタッフコード：
                <?php print $staff_code; ?>
            </div>
            <div class="info">
                スタッフ名：
                <?php print $staff_name; ?>
            </div>
        </div>
        <br />
        <br />
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </div>
</body>

</html>