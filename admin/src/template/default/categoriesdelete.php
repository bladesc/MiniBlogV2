<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=category&action=delete&id=<?= $this->data['categories']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac kategorie: <?= $this->data['categories']['name'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>