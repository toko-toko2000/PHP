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
    <title>ろくまる農園 | 商品選択なし</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <style>
        body {
            color: #898989;
            background-color: #efefef;
            font-family: "Zen Kurenaido", sans-serif;
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
            color: #F5B2B2;
            background-color: #ffffff;
            border: solid #898989 1px;
        }

        .button {
            text-align: right;

            a {
                margin-top: 80px;
                padding: 20px 0;
                display: inline-block;
                width: 200px;
                font-weight: bold;
                color: #F5B2B2;
                background-color: #ffffff;
                text-align: center;
                border: solid #898989 2px;
                transition: .5s ease-out;
            }

            a:hover {
                color: #EFEFEF;
                background-color: #898989;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <div class="info">
            商品が選択されていません。<br />
        </div>
        <div class="button">
            <a href="pro_list.php">戻る</a>
        </div>
    </div>
</body>

</html>