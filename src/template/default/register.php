<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['registerCommunicate'] ?></h1>
    <div id="section-register">
        <form method="post" action="index.php?page=register&action=create">
            <?php include 'layout/validationErrors.php' ?>
            <div>
                <label for="fNick"><?= $this->translations->pl['registerNick'] ?>:</label>
                <input type="text" name="fNick" id="fNick" class="medium">
            </div>
            <div>
                <label for="fEmail"><?= $this->translations->pl['registerEmail'] ?>:</label>
                <input type="email" name="fEmail" id="fEmail" class="medium">
            </div>
            <div>
                <label for="fPassword"><?= $this->translations->pl['registerPassword'] ?>:</label>
                <input type="password" name="fPassword" id="fPassword" class="medium">
            </div>
            <div>
                <label for="fPasswordProve"><?= $this->translations->pl['registerPasswordProve'] ?>:</label>
                <input type="password" name="fPasswordProve" id="fPasswordProve" class="medium">
            </div>
            <div>
                <input type="submit" name="fAdd" class="button lightgrey" value="<?= $this->translations->pl['buttonRegister'] ?>">
            </div>
        </form>
        <a href="index.php?page=login" class="standard"><?= $this->translations->pl['buttonLogin'] ?></a>
        <a href="index.php?page=remind" class="standard"><?= $this->translations->pl['buttonRemind'] ?></a>
    </div>

<?php include 'pagedown.php' ?>