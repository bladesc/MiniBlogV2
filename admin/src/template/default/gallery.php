<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=gallery&action=prepareCreate">Add new</a>
List of galleries
    list of entries
<?php if (isset($this->data['galleries'])) : ?>
    <?php foreach ($this->data['galleries'] as $gallery): ?>
        <div><?= $gallery['id'] ?></div>
        <div><?= $gallery['name'] ?></div>
        <div><?= $gallery['status'] ?></div>
        <div><?= $gallery['created_at'] ?></div>
        <div><?= $gallery['updated_at'] ?></div>
        <div>
            <%gallery=<?= $gallery['id'] ?>%>
        </div>
        <div>
            <a href="index.php?pageadmin=gallery&action=show&id=<?= $gallery['id'] ?>">Pokaz<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=gallery&action=prepareUpdate&id=<?= $gallery['id'] ?>">Zmien<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=gallery&action=prepareDelete&id=<?= $gallery['id'] ?>">Usun<a/>
        </div>
    <?php endforeach; ?>
<?php endif ?>

<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>