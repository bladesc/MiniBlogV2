<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=log&action=delete&id=<?= $this->data['logs']['id'] ?>" method="post">
        <div>
            Czy na pewno chesz usunac log: <?= $this->data['logs']['id'] ?>
            <input type="hidden" name="fId" value="<?= $this->data['logs']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?><?php
