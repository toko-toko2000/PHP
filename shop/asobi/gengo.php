<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園 | 元号を知る</title>
</head>

<body>
    <?php

    require_once('../common/common.php');

    $seireki = $_POST['seireki'];

    $wareki = gengo($seireki);
    print $wareki;
    ?>
</body>

</html>