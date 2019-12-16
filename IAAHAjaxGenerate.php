<?php
    require_once 'IAAH.php';

    $token = IAAH::generateRandomToken();
    $scenario = IAAH::generateRandomScenario();

    echo $scenario->getIAAHForm($token, true);
?>