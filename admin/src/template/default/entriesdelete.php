<?php include 'pageup.php' ?>

<h1>Usuwanie wpisu</h1>
    <form action="index.php?pageadmin=entry&action=delete&id=<?= $this->data['entries']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunąć wpis id: <b><?= $this->data['entries']['id'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['entries']['id'] ?>">
            <input type="submit" name="fDelete" value="Usuń" class="button lightblue">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>