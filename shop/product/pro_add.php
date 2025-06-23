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
            width: fit-content;
            color: #B2CBE4;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40)em;
        }

        .product {
            margin-top: 80px;
            color: #F5B2B2;
            background-color: #ffffff;
            border: solid #898989 1px;
        }

        .info {
            margin: 50px 30px;
            padding-bottom: 50px;
            border-bottom: solid #898989 1px;

            input {
                margin-top: 10px;
                padding: 10px;
                color: #EFEFEF;
                background-color: #898989;
            }
        }

        .info:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .button {
            margin: 50px 0 100px;
            text-align: center;

            input {
                margin: 0 30px;
                padding: 20px 0;
                width: 200px;
                height: 68px;
                color: #F5B2B2;
                background-color: #ffffff;
                font-weight: bold;
                border: solid #898989 2px;
                transition: .5s ease-out;
            }

            input:hover {
                color: #EFEFEF;
                background-color: #898989;
            }
        }
    </style>
</head>

<body>
    <div class="inner">
        <h2>商品追加</h2><br />
        <br />
        <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
            <div class="product">
                <div class="info">
                    商品名を入力してください。<br />
                    <input type="text" name="name" style="width:200px"><br />
                </div>
                <div class="info">
                    価格を入力してください。<br />
                    <input type="text" name="price" style="width:50px"> <br />
                </div>
                <div class="info">
                    画像を選んでください。<br />
                    <input type="file" name="gazou" style="width:400px"><br />
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