<?php include 'pageup.php' ?>

<h1><?= $this->translations->pl['passChange'] ?></h1>
<div id="section-login">
    <form method="post" action="index.php?page=change&action=processChange">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fOldPassword"><?= $this->translations->pl['passPasswordOld'] ?>:</label>
            <input type="password" class="medium" name="fOldPassword" id="fOldPassword">
        </div>
        <div>
            <label for="fNewPassword"><?= $this->translations->pl['passPasswordNew'] ?>:</label>
            <input type="password" class="medium" name="fNewPassword" id="fNewPassword">
        </div>
        <div>
            <label for="fNewPasswordProve"><?= $this->translations->pl['passPasswordNewProve'] ?>:</label>
            <input type="password" class="medium" name="fNewPasswordProve" id="fNewPasswordProve">
        </div>
        <div>
            <input type="submit" name="fChange" id="fChange" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightgrey">
        </div>

    </form>
</div>

<?php include 'pagedown.php' ?>
