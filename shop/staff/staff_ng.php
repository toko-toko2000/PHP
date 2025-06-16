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
    <title>ろくまる農園 | スタッフ選択なし</title>
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

        .info {
            margin-top: 100px;
            padding: 50px 30px;
            background-color: #ffffff;
            border: solid #001E43 1px;
        }

        .button {
            text-align: right;

            a {
                margin-top: 80px;
                padding: 20px 0;
                display: inline-block;
                width: 200px;
                font-weight: bold;
                background-color: #ffffff;
                text-align: center;
                border: solid #d9d9d9 2px;
                transition: .3s ease-out;
            }

            a:hover {
                border-color: #F19CA7;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <div class="info">
            スタッフが選択されていません。<br />
        </div>
        <div class="button">
            <a href="staff_list.php">戻る</a>
        </div>
    </div>
</body>

</html>