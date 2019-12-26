<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>

    <h1><?= $this->translations->pl['dirNotRemoved'] ?></h1>
<?= $this->translations->pl['dirNotRemoveCom'] ?>
    <div style="margin-top: 30px;">
        <a href="index.php" class="button lightblue"><?= $this->translations->pl['buttonRefresh'] ?></a>
    </div>
<?php include 'layout/footer.php' ?>