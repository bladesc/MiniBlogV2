<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=account&action=delete&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac uzytkownika: <?= $this->data['accounts']['user_email'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['accounts']['user_id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>