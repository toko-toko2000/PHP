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
    <title>ろくまる農園 | スタッフ一覧</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css"> -->
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
            padding-bottom: 3px;
            width: fit-content;
            font-size: 40px;
            font-weight: 400;
            line-height: (64/40)em;
            text-align: center;
            border-bottom: dotted #EA618E 5px;
        }

        form {
            margin-top: 50px;

            input {
                margin-top: 50px;
            }
        }

        .button {
            text-align: center;

            input[type="submit"] {
                display: inline-block;
                position: relative;
                margin: 50px 20px;
                padding: 20px 0;
                width: 200px;
                color: #6C3524;
                background-color: #ffffff;
                font-family: "RocknRoll One", sans-serif;
                font-weight: bold;
                border: solid #6C3524 2px;
                transition: .3s ease-out;
            }

            input[type="submit"]:hover {
                border-color: #EA618E;
            }
        }

        .link {
            text-align: right;

            a {
                position: relative;
                display: inline-block;
                color: #6C3524;
                font-weight: bold;
                text-decoration: none;
            }

            a::before {
                position: absolute;
                content: "";
                width: 0;
                height: 0;
                transition: .3s ease-out;
            }

            a::before {
                bottom: 0;
                left: 0;
                border-bottom: solid transparent 1px;
            }

            a:hover::before {
                width: 132.48px;
                height: 0;
                border-color: #6C3524;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php

        try {

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT code,name FROM mst_staff WHERE 1';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            print '<h2>スタッフ一覧</h2><br/><br/>';

            print '<form method="post" action="staff_branch.php">';

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }
                print '<input type="radio" name="staffcode" value="' . $rec['code'] . '">';
                print $rec['name'];
                print '<br/>';
            }
            print '<div class=button>';
            print '<input type="submit" name="disp" value="参照">';
            print '<input type="submit" name="add" value="追加">';
            print '<input type="submit" name="edit" value="修正">';
            print '<input type="submit" name="delete" value="削除">';
            print '</div>';
            print '</form>';
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
        ?>

        <br />
        <div class="link">
            <a href="../staff_login/staff_top.php">トップメニューへ</a><br />
        </div>
    </div>
</body>

</html>