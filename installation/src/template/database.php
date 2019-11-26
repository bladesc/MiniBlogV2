<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>

    <h1>Podaj dane dla połączenia bazy</h1>
    <form action="<?= $this->request->additional()->get('requestUri') ?>&action=checkConnection" method="post">
        <div class="box-input">
            Name
            <input name="dbname" value="<?= $this->request->post()->get('dbname') ?>" type="text"/>
        </div>
        Addres
        <div class="box-input">
            <input name="dbaddress" value="<?= $this->request->post()->get('dbaddress') ?>" type="text"/>
        </div>
        User
        <div class="box-input">
            <input name="dbuser" value="<?= $this->request->post()->get('dbuser') ?>" type="text"/>
        </div>
        Password
        <div class="box-input">
            <input name="dbpassword" value="<?= $this->request->post()->get('dbpassword') ?>" type="text"/>
        </div>
        <div class="box-communicate">
            <?php if ($this->request->post()->has('dbcheck')) : ?>
                <?php if ($this->data['connection'] === 'true') : ?>
                    <?= $this->translation['cocussess'] ?>;
                <?php else : ?>
                    <?= $this->translation['confailed'] ?>;
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <input type="submit" name="dbcheck" value="Check connection">

        <input type="submit" name="dbinstall" value="Install">
    </form>
<?php print_r($this->data); ?>
<?php include 'layout/footer.php' ?>