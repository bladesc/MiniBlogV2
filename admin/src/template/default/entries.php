<?php include 'pageup.php' ?>

    <a href="index.php?pageadmin=entry&action=prepareCreate">Add new</a>
    list of entries
<?php if (isset($this->data['entries'])) : ?>
    <?php foreach ($this->data['entries'] as $category): ?>
        <div><?= $category['id'] ?></div>
        <div><?= $category['title'] ?></div>
        <div><?= $category['content'] ?></div>
        <div><?= $category['created_at'] ?></div>
        <div><?= $category['name'] ?></div>
        <div><?= $category['nick'] ?></div>
        <div>
            <a href="index.php?pageadmin=entry&action=prepareUpdate&id=<?= $category['id'] ?>">Zmien<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=entry&action=prepareDelete&id=<?= $category['id'] ?>">Usun<a/>
        </div>
    <?php endforeach; ?>
<?php endif ?>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>