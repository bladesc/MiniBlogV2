<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>
Stara nazwa: <?= $this->data['categories']['name'] ?>
    <form action="index.php?pageadmin=category&action=update&id=<?= $this->data['categories']['id'] ?>" method="post">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="cNewName" <?= $this->request->post()->get('cNewName') ?>>
            <input type="hidden" name="cId" value="<?= $this->data['categories']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="cUpdate" value="Zmien">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'layout/sidebar.php' ?>
<?php include 'layout/footer.php' ?>