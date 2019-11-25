<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>

    <h1>Podaj dane dla połączenia bazy</h1>
    <form action="<?= $this->request->additional()->get('requestUri') ?>&action=checkConnection" method="post">
        <div class="box-input">
            Name
            <input name="dbname" type="text"/>
        </div>
        Addres
        <div class="box-input">
            <input name="dbaddress" type="text"/>
        </div>
        User
        <div class="box-input">
            <input name="dbuser" type="text"/>
        </div>
        Password
        <div class="box-input">
            <input name="dbpassword" type="text"/>
        </div>

        <button>Check connection</button>
        <input type="submit" name="dbinstall" value="Install">
    </form>
<?php print_r($this->data); ?>
<?php include 'layout/footer.php' ?>