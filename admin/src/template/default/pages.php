<?php include 'pageup.php' ?>
    <a href="index.php?pageadmin=page&action=prepareCreate">Add new</a>
<?php foreach ($this->data['pages'] as $page): ?>
    <div><?= $page['id'] ?></div>
    <div><?= $page['name'] ?></div>
    <div><?= $page['url'] ?></div>
    <div><?= $page['content'] ?></div>
    <div><?= $page['status'] ?></div>
    <div><?= $page['created_at'] ?></div>
    <div><?= $page['updated_at'] ?></div>
    <div><?= $page['title'] ?></div>
    <div><?= $page['description'] ?></div>
    <div><?= $page['tag'] ?></div>
    <div>
        <a href="index.php?pageadmin=page&action=prepareUpdate&id=<?= $page['id'] ?>">Zmien<a/>
    </div>
    <div>
        <a href="index.php?pageadmin=page&action=prepareDelete&id=<?= $page['id'] ?>">Usun<a/>
    </div>
<?php endforeach; ?>
<?php print_r($this->data); ?>
<?php include 'pagedown.php' ?>