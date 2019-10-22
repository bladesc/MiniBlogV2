<?php
if (file_exists('../Installation')) {
    $install = new \src\Core\Installation\Install();
    if (!$install->checkIfInstalled()) {
        header("Location: ../Installation/Installation.php");
        die;
    }
}