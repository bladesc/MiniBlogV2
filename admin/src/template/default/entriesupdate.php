<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>

    <form action="index.php?pageadmin=entry&action=update&id=<?= $this->data['entries']['id'] ?>" method="post">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="cTitle" value="<?= $this->data['entries']['title'] ?>">
            <input type="text" name="cContent" value="<?= $this->data['entries']['content'] ?>">
            <input type="hidden" name="cId" value="<?= $this->data['entries']['id'] ?>">
            <input type="text" name="cAuthor" value="1" hidden required>
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