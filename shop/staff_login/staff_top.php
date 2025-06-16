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
    <title>ろくまる農園 | トップ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&display=swap" rel="stylesheet">
    <style>
        body {
            margin-top: 150px;
            color: #6c3524;
            background-color: #2cb4ad;
            font-family: "RocknRoll One", sans-serif;
            letter-spacing: 0.05rem;
            text-align: center;
        }

        .inner {
            max-width: 1280px;
            width: 87%;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            margin-top: 100px;
            font-size: 50px;
            font-weight: bold;
            line-height: (80/50);
        }

        .button {
            margin-top: 150px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;

            a {
                width: 300px;
                padding: 30px 0;
                color: #6c3524;
                background-color: #ffffff;
                font-weight: bold;
                text-align: center;
                border: solid #6c3524 2px;
                transition: .3s ease-out;
            }

            a:hover {
                border-color: #ea618e;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <h1>ショップ管理トップメニュー<br /></h1>
        <br />
        <div class="button">
            <a href="../staff/staff_list.php">スタッフ管理</a>
            <a href="../product/pro_list.php">商品管理</a>
            <a href="../order/order_download.php">注文ダウンロード</a>
            <a href="staff_logout.php">ログアウト</a>
        </div>
    </div>
</body>

</html>