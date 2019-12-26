<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>
<?php
    $buttonType = 'disabled';
    $buttonStyle = 'disabled';
?>
    <h1><?= $this->translations->pl['dbSettings'] ?></h1>
    <form action="index.php?install_page=database&action=installation" method="post">
        <div class="box-input">
            <label for="dbname"><?= $this->translations->pl['dbName'] ?></label>
            <input name="dbname" id="dbname" value="<?= $this->request->post()->get('dbname') ?>" type="text"/>
        </div>
        <div class="box-input">
            <label for="dbaddress"><?= $this->translations->pl['dbAddress'] ?></label>
            <input name="dbaddress" id="dbaddress" value="<?= $this->request->post()->get('dbaddress') ?>" type="text"/>
        </div>
        <div class="box-input">
            <label for="dbuser"><?= $this->translations->pl['dbUser'] ?></label>
            <input name="dbuser" id="dbuser" value="<?= $this->request->post()->get('dbuser') ?>" type="text"/>
        </div>
        <div class="box-input">
            <label for="dbpassword"><?= $this->translations->pl['dbPass'] ?></label>
            <input name="dbpassword" id="dbpassword" value="<?= $this->request->post()->get('dbpassword') ?>"
                   type="text"/>
        </div>

        <div class="box-communicate">
            <?php if ($this->request->post()->has('dbcheck') || $this->request->post()->has('dbinstall')) : ?>
                <?php if ($this->data['connection'] === true) : ?>
                    <?php $buttonType = '' ?>
                    <?php $buttonStyle = '' ?>
                    <div class="positive comunicate">
                        <?= $this->translations->pl['connectionSuccess'] ?>;
                    </div>
                <?php else : ?>
                    <div class="negative comunicate">
                        <?= $this->translations->pl['connectionFail'] ?>;
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <input type="submit" name="dbcheck" value="<?= $this->translations->pl['dbCheck'] ?>" class="button lightgrey">

        <input type="submit" name="dbinstall" value="<?= $this->translations->pl['dbInstall'] ?>" class="button lightblue <?= $buttonStyle ?>" <?= $buttonType ?>>
    </form>

<?php include 'layout/footer.php' ?>