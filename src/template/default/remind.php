<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['remindCommunicate'] ?></h1>
    <div id="section-login">
        <form method="post" action="index.php?page=remind&action=processRemind">
            <?php include 'layout/validationErrors.php' ?>
            <div>
                <label for="fEmail">Adres e-mail:</label>
                <input type="email" name="fEmail" id="fEmail" class="medium">
            </div>
            <div>
                <input type="submit" name="fRemind" value="<?= $this->translations->pl['buttonRemind'] ?>" class="button lightgrey">
            </div>
        </form>
        <a href="index.php?page=login" class="standard"><?= $this->translations->pl['buttonLogin'] ?></a>
        <a href="index.php?page=register" class="standard"><?= $this->translations->pl['buttonRegister'] ?></a>
    </div>


<?php include 'pagedown.php' ?>