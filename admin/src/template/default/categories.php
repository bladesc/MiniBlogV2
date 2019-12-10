<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=category&action=prepareCreate">Add new</a>
list of cateogiresa

<?php foreach ($this->data['categories'] as $category): ?>
    <div><?= $category['id'] ?></div>
    <div><?= $category['name'] ?></div>
    <div><?= $category['status'] ?></div>
    <div>
        <a href="index.php?pageadmin=category&action=prepareUpdate&id=<?= $category['id'] ?>">Zmien<a/>
    </div>
    <div>
        <a href="index.php?pageadmin=category&action=prepareDelete&id=<?= $category['id'] ?>">Usun<a/>
    </div>
<?php endforeach; ?>

<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>



