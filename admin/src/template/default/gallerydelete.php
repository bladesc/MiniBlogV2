<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=gallery&action=delete&id=<?= $this->data['galleries']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac kategorie: <?= $this->data['galleries']['name'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['galleries']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>