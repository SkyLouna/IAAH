<?php

    /**
     * Author: Trana Valentin
     * Description:
     *              Check a IAAH Form result and if has passed, the user receive a pass token
     */

    require_once 'IAAH.php';

    //If session not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //check if user has passed
    $hasPassed = IAAH::checkUser($_POST);

    //Return no pass
    if(!$hasPassed){
        echo 0;
        return;
    }

    //Generate a random token
    $accessToken = IAAH::generateRandomToken();

    //Set user access token
    $_SESSION['iaah_accesstoken'] = $accessToken->getKey();
    echo 1;


?>