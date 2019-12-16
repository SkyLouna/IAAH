<?php

    require_once 'IAAH.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $hasPassed = IAAH::checkUser($_POST);

    if(!$hasPassed){
        echo 0;
        return;
    }

    $accessToken = IAAH::generateRandomToken();

    $_SESSION['iaah_accesstoken'] = $accessToken->getKey();
    echo 1;


?>