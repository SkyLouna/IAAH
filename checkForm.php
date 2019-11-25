<?php

    require_once 'IAAH.php';

    $hasPassed = IAAH::checkUser($_POST);

    echo 'haspassed: '.$hasPassed;
?>