<?php include 'pageup.php' ?>
    <form action="index.php?pageadmin=page&action=delete&id=<?= $this->data['pages']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac stone: <?= $this->data['pages']['name'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['pages']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>