<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>

    Podaj dane dla połączenia bazy
<form action="<?= $this->request->additional()->get('requestUri') ?>" method="post">
    <input name="dbname" type="text"/>
    <input name="dbaddress" type="text"/>
    <input name="dbuser" type="text"/>
    <input name="dbpassword" type="text"/>
    <button>Check connection</button>
    <input type="submit" name="dbsubmit">
</form>
<?php print_r($this->data); ?>
<?php include 'layout/footer.php' ?>