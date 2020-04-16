<?php require_once("config/index.php");

if (!empty($_POST)) {

    // Get and clean inputs
    // ---------------------------------------------------------------- //
    try {
        foreach ($_POST as $name => $value) {
            $form[htmlspecialchars($name)] = htmlspecialchars($value);
        }
    } catch (Exception $e) {
        $_SESSION['errors']['inputs'] = $e;
    }
    // ---------------------------------------------------------------- //


    // handle submit
}

$db->disconnect();
