<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=comment&action=delete&id=<?= $this->data['comments']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac kategorie: <?= $this->data['comments']['content'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>