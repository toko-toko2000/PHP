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
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <style>
        body {
            color: #898989;
            background-color: #EFEFEF;
            font-family: "Zen Kurenaido", sans-serif;
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
            color: #B2CBE4;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40)em;
            text-align: center;
        }

        form {
            margin-top: 50px;

            input {
                margin-top: 50px;
            }
        }

        .button {
            text-align: center;

            .wrapper {
                position: relative;
                display: inline-block;

                input {
                    margin: 80px 20px;
                    padding: 20px 40px;
                    position: relative;
                    color: #000000;
                    background-color: #ffffff;
                    font-weight: bold;
                    text-decoration: none;
                    border: solid #eb6ea0 2px;
                    border-radius: 50px;
                    transition: .3s ease-out;
                }
            }


            .wrapper::before,
            .wrapper::after {
                position: absolute;
                content: "";
                width: 0;
                height: 0;
                transition: .3s ease-out;
            }

            .wrapper::before {
                left: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            .wrapper::after {
                right: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            .wrapper:hover::before,
            .wrapper:hover::after {
                width: 50px;
                height: 0;
                border-bottom-color: #ffffff;
            }

            input:hover {
                color: #ffffff;
                background-color: #eb6ea0;
            }
        }


        .link {
            text-align: right;

            a {
                margin-bottom: 80px;
                position: relative;
                display: inline-block;
                color: #898989;
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
                border-color: #898989;
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
            print '<div class="wrapper"><input type="submit" name="disp" value="参照"></div>';
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