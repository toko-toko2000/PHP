<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | ご購入手続き</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&family=Noto+Sans+JP:wght@100..900&family=Pacifico&family=RocknRoll+One&family=Sacramento&family=Zen+Kurenaido&family=Zen+Maru+Gothic&family=Zen+Old+Mincho&display=swap"
        rel="stylesheet">
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

        .link {
            margin: 100px 0;
            text-align: right;

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

        require_once('../common/common.php');

        $post = sanitize($_POST);

        $onamae = $post['onamae'];
        $email = $post['email'];
        $postal1 = $post['postal1'];
        $postal2 = $post['postal2'];
        $address = $post['address'];
        $tel = $post['tel'];
        $chumon = $post['chumon'];
        $pass = $post['pass'];
        $pass2 = $post['pass2'];
        $danjo = $post['danjo'];
        $birth = $post['birth'];

        $okflg = true;

        if ($onamae == '') {
            print '<div class="info">';
            print 'お名前が入力されていません。<br/><br/>';
            print '</div>';
            $okflg = false;
        } else {
            print '<div class="info">';
            print '<p>';
            print 'お名前<br/>';
            print '</p>';
            print $onamae;
            print '<br/><br/>';
            print '</div>';
        }

        if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0) {
            print '<div class="info">';
            print 'メールアドレスを正確に入力してください。<br/><br/>';
            print '</div>';
            $okflg = false;
        } else {
            print '<div class="info">';
            print '<p>';
            print 'メールアドレス<br/>';
            print '</p>';
            print $email;
            print '<br/><br/>';
            print '</div>';
        }

        if (preg_match('/\A[0-9]+\z/', $postal1) == 0) {
            print '<div class="info">';
            print '郵便番号は半角数字で入力してください。<br/><br/>';
            print '</div>';
            $okflg = false;
        } else {
            print '<div class="info">';
            print '<p>';
            print '郵便番号<br/>';
            print '</p>';
            print $postal1;
            print '-';
            print $postal2;
            print '<br/><br/>';
            print '</div>';
        }

        if (preg_match('/\A[0-9]+\z/', $postal2) == 0) {
            print '<div class="info">';
            print '郵便番号は半角数字で入力してください。<br/><br/>';
            print '</div>';
            $okflg = false;
        }

        if ($address == '') {
            print '<div class="info">';
            print '住所が入力されていません。<br/><br/>';
            print '</div>';
            $okflg = false;
        } else {
            print '<div class="info">';
            print '<p>';
            print '住所<br/>';
            print '</p>';
            print $address;
            print '<br/><br/>';
            print '</div>';
        }

        if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0) {
            print '<div class="info">';
            print '電話番号を正確に入力してください。<br/><br/>';
            print '</div>';
            $okflg = false;
        } else {
            print '<div class="info">';
            print '<p>';
            print '電話番号<br/>';
            print '</p>';
            print $tel;
            print '<br/><br/>';
            print '</div>';
        }

        if ($chumon == 'chumontouroku') {
            if ($pass == '') {
                print '<div class="info">';
                print 'パスワードが入力されていません。';
                print '</div>';
                $okflg = false;
            }

            if ($pass != $pass2) {
                print '<div class="info">';
                print 'パスワードが一致しません。';
                print '</div>';
                $okflg = false;
            }

            print '<div class="info">';
            print '<p>';
            print '性別<br/>';
            print '</p>';
            if ($danjo == 'ban') {
                print '男性';
            } else {
                print '女性';
            }
            print '<br/><br/>';
            print '</div>';

            print '<div class="info">';
            print '<p>';
            print '生まれ年<br/>';
            print '</p>';
            print $birth;
            print '年代';
            print '<br/><br/>';
            print '</div>';
        }

        if ($okflg == true) {
            print '<form method="post" action="shop_form_done.php">';
            print '<input type="hidden" name="onamae" value="' . $onamae . '">';
            print '<input type="hidden" name="email" value="' . $email . '">';
            print '<input type="hidden" name="postal1" value="' . $postal1 . '">';
            print '<input type="hidden" name="postal2" value="' . $postal2 . '">';
            print '<input type="hidden" name="address" value="' . $address . '">';
            print '<input type="hidden" name="tel" value="' . $tel . '">';
            print '<input type="hidden" name="chumon" value="' . $chumon . '">';
            print '<input type="hidden" name="pass" value="' . $pass . '">';
            print '<input type="hidden" name="danjo" value="' . $danjo . '">';
            print '<input type="hidden" name="birth" value="' . $birth . '">';
            print '<div class="button">';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK"><br/>';
            print '</div>';
            print '</form>';
        } else {
            print '<form>';
            print '<div class="link">';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</div>';
            print '</form>';
        }

        ?>
    </div>
</body>

</html>