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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <form action="checkForm.php" method="POST" class="IAAHFormCheck">

            <p>
                <input type="text" name="form_name" placeholder="Your name">
            </p>

            <p>
                <input type="text" name="form_surname" placeholder="Your surname">
            </p>

            <?php echo $scenario->getIAAHForm($token, true); ?>

            <p>
                <input type="email" name="form_email" placeholder="Your email">
            </p>

            <p>
                <button type="submit" required>Submit the form</button>
            </p>
        </form>
    </body>
</html>