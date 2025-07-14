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
    <title>ろくまる農園 | 商品追加</title>
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
                background-color: #bee0c2;
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
        <h1>商品追加</h1><br />
        <br />
        <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
            <div class="product">
                <div class="info">
                    商品名を入力してください。<br />
                    <input type="text" name="name" style="width:700px"><br />
                </div>
                <div class="info">
                    価格を入力してください。<br />
                    <input type="text" name="price" style="width:700px"> <br />
                </div>
                <div class="info">
                    画像を選んでください。<br />
                    <input type="file" name="gazou" style="width:700px"><br />
                </div>
            </div>
            <div class="button">
                <input type="button" onclick="history.back()" value="戻る">
                <input type="submit" value="OK">
            </div>
        </form>
    </div>
</body>

</html>