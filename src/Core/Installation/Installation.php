<?php
if (file_exists('../src/Installation')) {
    $install = new \src\Core\Installation\Install();
    if (!$install->checkIfInstalled()) {
        header("Location: ");
        die;
    }
}