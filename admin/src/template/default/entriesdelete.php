<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=entry&action=delete&id=<?= $this->data['entries']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac kategorie: <?= $this->data['entries']['title'] ?>
            <input type="hidden" name="cId" value="<?= $this->data['entries']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="cDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>