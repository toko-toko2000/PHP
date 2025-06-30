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
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&display=swap"
        rel="stylesheet">
    <style>
        h1 {
            margin: 100px 0;
            font-size: 36px;
            font-weight: 600;
            line-height: (57.6/36)em;
            text-align: center;
        }


        .link {
            text-align: center;

            a {
                margin: 80px 20px;
                padding: 20px 40px;
                display: inline-block;
                color: #000000;
                background-color: #ffffff;
                font-weight: bold;
                text-decoration: none;
                border-radius: 50px;
                transition: .3s ease-out;

                p {
                    position: relative;
                }
            }

            p::before,
            p::after {
                position: absolute;
                content: "";
                width: 0;
                height: 0;
                transition: .5s ease-out;
            }

            p::before {
                left: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            p::after {
                right: 50%;
                bottom: -5px;
                border-bottom: solid transparent 1px;
            }

            p:hover::before,
            p:hover::after {
                width: 50px;
                height: 0;
                border-bottom-color: #ffffff;
            }

            a:hover {
                color: #ffffff;
            }
        }

        .link1 {
            border: solid #eb6ea0 2px;
        }

        .link1:hover {
            background-color: #eb6ea0;
        }

        .link2 {
            border: solid #00a960 2px;

            p:hover::before,
            p:hover::after {
                width: 25px;
                height: 0;
                border-bottom-color: #ffffff;
            }
        }

        .link2:hover {
            background-color: #00a960;
        }

        .link3 {
            border: solid #0075c2 2px;
        }

        .link3:hover {
            background-color: #0075c2;
        }

        .link4 {
            border: solid #ee7800 2px;

            p:hover::before,
            p:hover::after {
                width: 25px;
                height: 0;
                border-bottom-color: #ffffff;
            }
        }

        .link4:hover {
            background-color: #ee7800;
        }
    </style>
</head>

<body>
    <div class="inner">
        <h1>ショップ管理トップメニュー</h1>
        <div class="link">
            <a class="link1" href="../staff/staff_list.php">
                <p>スタッフ管理</p>
            </a>
            <a class="link2" href="../product/pro_list.php">
                <p>商品管理</p>
            </a>
            <a class="link3" href="../order/order_download.php">
                <p>注文ダウンロード</p>
            </a>
            <a class="link4" href="staff_logout.php">
                <p>ログアウト</p>
            </a>
        </div>
    </div>
</body>

</html>