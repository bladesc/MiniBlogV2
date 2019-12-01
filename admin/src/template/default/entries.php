<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>
    <a href="index.php?pageadmin=entry&action=prepareCreate">Add new</a>
    list of entries
<?php if(isset($this->data['entries'])) : ?>
<?php foreach ($this->data['entries'] as $category): ?>
    <div><?= $category['id'] ?></div>
    <div><?= $category['title'] ?></div>
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
<?php include 'layout/sidebar.php' ?>
<?php include 'layout/footer.php' ?>