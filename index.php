<?php

    require_once 'IAAH.php';

    $token = IAAH::generateRandomToken();
    $scenario = IAAH::generateRandomScenario();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Title</title>
    </head>
    <body>
        <form action="checkForm.php" method="POST">
            <?php echo $scenario->getIAAHForm($token); ?>

            <p>
                <button type="submit">Submit</button>
            </p>
        </form>
    </body>
</html>