    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | カートを見る</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&family=Zen+Maru+Gothic&family=Zen+Old+Mincho&display=swap" rel="stylesheet">
    <style>
        body {
            margin-top: 150px;
            color: #000000;
            background-color: #ffffff;
            font-family: "Noto Sans JP", sans-serif;
            text-align: center;
            letter-spacing: (5/1000)rem;
        }

        .inner {
            width: 90%;
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }

        .info {
            text-align: left;
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
    </style>
    <div class="inner">
        <?php
        session_start();
        session_regenerate_id(true);

        require_once('../common/common.php');

        $post = sanitize($_POST);

        $max = $post['max'];
        for ($i = 0; $i < $max; $i++) {
            if (preg_match("/\A[0-9]+\z/", $post['kazu' . $i]) == 0) {
                print '数量に誤りがあります。';
                print '<a href="shop_cartlook.php">カートに戻る</a>';
                exit();
            }
            if ($post['kazu' . $i] < 1 || 10 < $post['kazu' . $i]) {
                print '<div class="info">';
                print '数量は必ず1個以上、10個までです。';
                print '</div>';
                print '<div class="link">';
                print '<a href="shop_cartlook.php">カートに戻る</a>';
                print '</div>';
                exit();
            }
            $kazu[] = $post['kazu' . $i];
        }
        $cart = $_SESSION['cart'];

        for ($i = $max; 0 <= $i; $i--) {
            if (isset($_POST['sakujo' . $i]) == true) {
                array_splice($cart, $i, 1);
                array_splice($kazu, $i, 1);
            }
        }
        $_SESSION['cart'] = $cart;
        $_SESSION['kazu'] = $kazu;

        header('Location:shop_cartlook.php');
        exit();
        ?>
    </div>