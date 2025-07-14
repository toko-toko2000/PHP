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
    <title>ろくまる農園 | 商品削除</title>
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
            text-align: center;

            input {
                margin: 0 50px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #009944 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input:hover {
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

            $pro_code = $_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,gazou FROM mst_product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_gazou_name = $rec['gazou'];

            $dbh = null;

            if ($pro_gazou_name == '') {
                $disp_gazou = '';
            } else {
                $disp_gazou = '<img src="./gazou/' . $pro_gazou_name . '" alt="">';
            }
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <h1>商品削除</h1><br />
        <br />
        <div class="info">
            商品コード<br />
            <?php print $pro_code; ?>
        </div>
        <div class="info">
            商品名<br />
            <?php print $pro_name; ?>
        </div>
        <div class="info">
            <?php print $disp_gazou; ?>
        </div>
        <br />
        この商品を削除してよろしいですか？
        <br />
        <div class="button">
            <form method="post" action="pro_delete_done.php">
                <input type="hidden" name="code" value="<?php print $pro_code; ?>">
                <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name; ?>">
                <input type="button" onclick="history.back()" value="戻る">
                <input type="submit" value="OK">
            </form>
        </div>
    </div>
</body>

</html>