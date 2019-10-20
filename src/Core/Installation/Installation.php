<?php
if (is_dir('../../Installation')) {
    $install = new \src\Installation\Install();
    if (!$install->checkIfInstalled()) {
        header("Location: ");
        die;
    }
}