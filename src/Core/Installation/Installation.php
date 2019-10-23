<?php
if (file_exists('../Installation')) {
    $install = new \src\Core\Installation\Install();
    if (!$install->checkIfInstalled()) {
        header("Location: ../Installation/Installation.php");
        die;
    }
    if ($install->getCheckInstallDir()) {
        header("Location: ../Installation/Installation.php&page=notRemoved");
        die;
    }
}