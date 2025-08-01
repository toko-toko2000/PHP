<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    print '<div class="login">';
    print 'ようこそゲスト様 ';
    print '<a href="member_login.html">会員ログイン</a>';
    print '</div>';
} else {
    print '<div class="login">';
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様 ';
    print '<a href="member_logout.php">ログアウト</a><br/>';
    print '<br/>';
    print '</div>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | カートを見る</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css"> -->
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

        .login {
            a {
                display: inline-block;
                color: #000000;
                transition: .3s ease-out;
                text-decoration: none;
            }

            a:hover {
                color: #d70035;
                transform: scale(1.1);
            }
        }

        .info {
            margin-top: 100px;
            line-height: 1.6;
        }

        .link {
            margin: 100px 0;
            text-align: right;

            a {
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                color: #000000;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                text-decoration: none;
                border: solid #7f1184 3px;
                border-radius: 60px;
                transition: .3s ease-out;
            }

            a:hover {
                color: #ffffff;
                background-color: #7f1184;
            }
        }

        table {
            width: 100%;
            border: solid #000000 1px;
            border-collapse: collapse;

            tt,
            td {
                padding: 30px;
                text-align: center;
                vertical-align: center;
                border: solid #000000 1px;
            }

            td:nth-child(4) {
                input {
                    width: 120px;
                    padding: 20px;
                    border: solid #000000 1px;
                }
            }

            td:nth-child(5) {
                input {
                    border: solid #000000 1px;
                }
            }

            input[type="text"] {
                text-align: center;
            }
        }

        h2 {
            margin-top: 100px;
            font-size: 40px;
            font-weight: bold;
            line-height: (64/40);
            text-align: center;
        }

        .button {
            margin: 50px 0;
            text-align: left;

            input {
                padding: 40px 0;
                display: inline-block;
                width: 300px;
                color: #000000;
                background-color: transparent;
                font-size: 20px;
                font-weight: bold;
                line-height: (32/20);
                text-align: center;
                text-decoration: none;
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

        try {
            if (isset($_SESSION['cart']) == true) {
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);
            } else {
                $max = 0;
            }

            if ($max == 0) {
                print '<div class="info">';
                print 'カートに商品が入っていません。<br/>';
                print '</div>';
                print '<br/>';
                print '<div class="link">';
                print '<a href="shop_list.php">商品一覧へ戻る</a>';
                print '</div>';
                exit();
            }

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            foreach ($cart as $key => $val) {
                $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
                $stmt = $dbh->prepare($sql);
                $data[0] = $val;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                $pro_name[] = $rec['name'];
                $pro_price[] = $rec['price'];
                if ($rec['gazou'] == '') {
                    $pro_gazou[] = '';
                } else {
                    $pro_gazou[] = '<img src="../product/gazou/' . $rec['gazou'] . '">';
                }
            }
            $dbh = null;
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

        ?>

        <h2>カートの中身</h2>
        <br />
        <form method="post" action="kazu_change.php">
            <table border="1">
                <tr>
                    <td>商品</td>
                    <td>商品画像</td>
                    <td>価格</td>
                    <td>数量</td>
                    <td>小計</td>
                    <td>削除</td>
                </tr>
                <?php for ($i = 0; $i < $max; $i++) {
                ?>
                    <tr>
                        <td><?php print $pro_name[$i]; ?></td>
                        <td><?php print $pro_gazou[$i]; ?></td>
                        <td><?php print $pro_price[$i] . '円'; ?></td>
                        <td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
                        <td><?php print $pro_price[$i] * $kazu[$i]; ?>円</td>
                        <td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
                        <br />
                    </tr>
                <?php
                }
                ?>
            </table>
            <input type="hidden" name="max" value="<?php print $max; ?>">
            <div class="button">
                <input type="submit" value="数量変更"><br />
            </div>
            <div class="button">
                <input type="button" onclick="history.back()" value="戻る">
            </div>
        </form>
        <br />
        <div class="link">
            <a href="shop_form.html">ご購入手続きへ進む</a><br />
        </div>

        <?php
        if (isset($_SESSION["member_login"]) == true) {
            print '<a href="shop_kantan_check.php">会員かんたん注文へ進む</a><br/>';
        }
        ?>
    </div>
</body>

</html>