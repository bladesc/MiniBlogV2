<?php include 'pageup.php' ?>

    <div>
        Title:
        <?= $this->data['settings'][0]['title'] ?>
    </div>
    <div>
        Description:
        <?= $this->data['settings'][0]['description'] ?>
    </div>
    <div>
        Meta tags:
        <?= $this->data['settings'][0]['meta_tags'] ?>
    </div>
    <div>
        <a href="index.php?pageadmin=settings&action=prepareUpdate&id=<?= $this->data['settings'][0]['id'] ?>">Zmien<a/>
    </div>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>