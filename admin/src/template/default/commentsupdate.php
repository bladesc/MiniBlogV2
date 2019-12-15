<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=comment&action=update&id=<?= $this->data['comments']['id'] ?>" method="post">
        <div>
            <input type="text" name="fContent" value="<?= $this->data['comments']['content'] ?>">
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fSubmit" value="Zmien">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>