<?php
/**
 * Author: Trana Valentin
 * Description:
 *              Generates an IAAH form (used for ajax loading)
 */ 
    require_once 'IAAH.php';

    //Generate token and pickup random scenario
    $token = IAAH::generateRandomToken();
    $scenario = IAAH::generateRandomScenario();

    //echo the form
    echo $scenario->getIAAHForm($token, true);
?>