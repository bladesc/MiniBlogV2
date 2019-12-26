<?php include 'pageup.php' ?>
<a href="index.php?pageadmin=settings&action=prepareUpdate&id=<?= $this->data['settings'][0]['id'] ?>" class="button lightblue addnew">Edytuj<a/>
    <h1><?= $this->translations->pl['h1SettingsList'] ?></h1>
    <h3><?= $this->translations->pl['tableSeo'] ?></h3>
    <div id="box-settings">
        <div>
            <?= $this->translations->pl['tableSeoTitle'] ?>:
            <?= $this->data['settings'][0]['title'] ?>
        </div>
        <div>
            <?= $this->translations->pl['tableSeoDescription'] ?>:
            <?= $this->data['settings'][0]['description'] ?>
        </div>
        <div>
            <?= $this->translations->pl['tableSeoTags'] ?>:
            <?= $this->data['settings'][0]['meta_tags'] ?>
        </div>
    </div>

<?php include 'pagedown.php' ?>