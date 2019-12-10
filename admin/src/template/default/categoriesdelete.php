<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=category&action=delete&id=<?= $this->data['categories']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac kategorie: <?= $this->data['categories']['name'] ?>
            <input type="hidden" name="cId" value="<?= $this->data['categories']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="cDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>