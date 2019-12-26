<?php include 'pageup.php' ?>

<h1><?= $this->translations->pl['loginCommunicate'] ?></h1>
<div id="section-login">
    <form method="post" action="index.php?page=login&action=processLogin">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fEmail"><?= $this->translations->pl['loginEmail'] ?>:</label>
            <input type="email" name="fEmail" id="fEmail" class="medium">
        </div>
        <div>
            <label for="fPassword"><?= $this->translations->pl['loginPassword'] ?>:</label>
            <input type="password" name="fPassword" id="fPassword" class="medium">
        </div>
        <div>
            <input type="submit" name="fLogin" class="button lightgrey" value="<?= $this->translations->pl['buttonLogin'] ?>">
        </div>
    </form>
    <a href="index.php?page=register" class="standard"><?= $this->translations->pl['buttonRegister'] ?></a>
    <a href="index.php?page=remind" class="standard"><?= $this->translations->pl['buttonRemind'] ?></a>
</div>

<?php include 'pagedown.php' ?>
