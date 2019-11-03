<?php

if (file_exists('../Installation')) {
    $install = new \src\Core\Installation\Install();
    if (!$install->checkIfInstalled()) {
        if(isset($_GET['page'])) {
            if ($_GET['page'] !== 'installation') {
                header('location: index.php?page=installation&action=step1');
            }
        } else {
            header('location: index.php?page=installation&action=step1');
        }
    } elseif ($install->getCheckInstallDir()) {
        if(isset($_GET['page'])) {
            if ($_GET['page'] !== 'installation') {
                header('location: index.php?page=installation&action=notremoved');
            }
        } else {
            header('location: index.php?page=installation&action=notremoved');
        }
    }
}