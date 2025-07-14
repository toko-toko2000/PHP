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
    <title>ろくまる農園 | 商品一覧</title>
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

        form {

            input:first-child {
                margin-top: 100px;
            }

            input {
                margin-top: 50px;
            }
        }

        .button {
            margin-top: 100px;

            input[name="disp"] {
                margin: 0 10px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[name="disp"]:hover {
                color: #ffffff;
                background-color: #009944;
            }

            input[name="add"] {
                margin: 0 10px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[name="add"]:hover {
                color: #ffffff;
                background-color: #009944;
            }

            input[name="edit"] {
                margin: 0 10px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[name="edit"]:hover {
                color: #ffffff;
                background-color: #009944;
            }

            input[name="delete"] {
                margin: 0 10px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input[name="delete"]:hover {
                color: #ffffff;
                background-color: #009944;
            }
        }

        .link {
            margin: 150px 0 100px;
            text-align: right;

            a {
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                color: #000000;
                background-color: #ffffff;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                text-decoration: none;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            a:hover {
                color: #ffffff;
                background-color: #009944;
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

            $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            print '<h1>商品一覧</h1><br/><br/>';

            print '<form method="post" action="pro_branch.php">';

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }
                print '<input type="radio" name="procode" value="' . $rec['code'] . '">';
                print $rec['name'] . '---';
                print $rec['price'] . '円';
                print '<br/>';
            }
            print '<div class="button">';
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