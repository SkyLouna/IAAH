<?php

    require_once 'IAAHFileUtils.php';
    require_once 'IAAHToken.php';


    $token1 = new IAAHToken(1234456789, 32);
    $token2 = new IAAHToken(652353546, 54);
    $token3 = new IAAHToken(571835738042, 43);

    IAAHFileUtils::saveToken($token1);

    echo 1;

?>