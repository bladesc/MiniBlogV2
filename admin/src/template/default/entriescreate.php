<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>
    <form action="index.php?pageadmin=entry&action=create" method="post">
        <div>
            Wprowadz nazwe wpisu
            <input type="text" name="cTitle" value="<?= $this->request->post()->get('cTitle') ?>">
            <input type="text" name="cContent" value="<?= $this->request->post()->get('cContent') ?>">
            <input type="text" name="cAuthor" value="1" hidden required>
        </div>
        <div>
            <input type="submit" name="cSubmin" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'layout/sidebar.php' ?>
<?php include 'layout/footer.php' ?>