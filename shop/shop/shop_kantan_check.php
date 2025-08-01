<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    print 'ログインされていません。<br/>';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | ご購入手続き</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | 商品参照</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
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

        .info {
            margin-top: 100px;
        }

        .button {
            margin: 100px 0;
            text-align: center;

            input {
                margin: 0 30px;
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                background-color: transparent;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                border: solid #7f1184 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            input:hover {
                color: #ffffff;
                background-color: #7f1184;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <?php
        $code = $_SESSION['member_code'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        $onamae = $rec['name'];
        $email = $rec['email'];
        $postal1 = $rec['postal1'];
        $postal2 = $rec['postal2'];
        $address = $rec['address'];
        $tel = $rec['tel'];

        print '<div class="info">';
        print 'お名前<br/>';
        print $onamae;
        print '<br/><br/>';
        print '</div>';

        print '<div class="info">';
        print 'メールアドレス<br/>';
        print $email;
        print '<br/><br/>';
        print '</div>';

        print '<div class="info">';
        print '郵便番号<br/>';
        print $postal1;
        print '-';
        print $postal2;
        print '<br/><br/>';
        print '</div>';

        print '<div class="info">';
        print '住所<br/>';
        print $address;
        print '<br/><br/>';
        print '<?div>';

        print '<div class="info">';
        print '電話番号<br/>';
        print $tel;
        print '<br/><br/>';
        print '</div>';

        print '<form method="post" action="shop_kantan_done.php">';
        print '<input type="hidden" name="onamae" value="' . $onamae . '">';
        print '<input type="hidden" name="email" value="' . $email . '">';
        print '<input type="hidden" name="postal1" value="' . $postal1 . '">';
        print '<input type="hidden" name="postal2" value="' . $postal2 . '">';
        print '<input type="hidden" name="address" value="' . $address . '">';
        print '<input type="hidden" name="tel" value="' . $tel . '">';
        print '<div class="button">';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK"><br/>';
        print '</div>';
        print '<form>';
        ?>
    </div>
</body>

</html>