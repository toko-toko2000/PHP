<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | 星の検索</title>
</head>

<body>
    <?php

    $mbango = $_POST['mbango'];

    $hoshi['M1'] = 'カニ星雲';
    $hoshi['M31'] = 'アンドロメダ大星雲';
    $hoshi['M42'] = 'オリオン大星雲';
    $hoshi['M45'] = 'すばる';
    $hoshi['M57'] = 'ドーナツ星雲';

    foreach ($hoshi as $key => $val) {
        print $key . 'は' . $val;
        print '<br/>';
    }

    print 'あなたが選んだ星は、';
    print $hoshi[$mbango];

    ?>
</body>

</html>