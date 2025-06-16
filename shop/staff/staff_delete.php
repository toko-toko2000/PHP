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
    <title>ろくまる農園 | スタッフ削除</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <style>
        body {
            color: #001E43;
            background-color: #B2CBE4;
            font-family: 'Times New Roman', Times, serif;
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
            border-bottom: solid #F19CA7 2px;
        }

        .info {
            margin-top: 80px;
            padding: 50px 30px;
            background-color: #ffffff;
            border: solid #001E43 1px;
        }

        .delete {
            margin-top: 50px;
            text-align: center;

            input {
                margin: 30px 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                background-color: #ffffff;
                font-weight: bold;
                border: solid #d9d9d9 2px;
                transition: .3s ease-out;
            }

            input:hover {
                border-color: #F19CA7;
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

        <h2>スタッフ削除</h2><br />
        <br />
        <div class="info">
            スタッフコード：
            <?php print $staff_code; ?>
        </div>
        <br />
        <div class="info">
            スタッフ名：
            <?php print $staff_name; ?>
        </div>
        <br />
        <div class="delete">
            このスタッフを削除してよろしいですか？
            <br />
            <form method="post" action="staff_delete_done.php">
                <input type="hidden" name="code" value="<?php print $staff_code; ?>">
                <input type="button" onclick="history.back()" value="戻る">
                <input type="submit" value="OK">
            </form>
        </div>
    </div>
</body>

</html>