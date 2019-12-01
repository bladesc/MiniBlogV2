<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>
    <form action="index.php?pageadmin=category&action=create" method="post">
        <div>
            Wprowadz nazwe kategorii
            <input type="text" name="cName" value="<?= $this->request->post()->get('cName') ?>">
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