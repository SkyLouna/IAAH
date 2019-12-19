<?php

    /**
     * Author: Trana Valentin
     * Description:
     *              Just a page to check if user has passed
     */

    require_once 'IAAH.php';

    $hasPassed = IAAH::checkUser($_POST);

    echo 'haspassed the IAAH: '.$hasPassed;
?>