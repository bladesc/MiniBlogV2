<?php include 'pageup.php' ?>
<?php if (isset($this->data['comments'])) : ?>
    <?php foreach ($this->data['comments'] as $comment): ?>
        <div><?= $comment['id'] ?></div>
        <div><?= $comment['user_id'] ?></div>
        <div><?= $comment['content'] ?></div>
        <div><?= $comment['entry_id'] ?></div>
        <div>
            <a href="index.php?pageadmin=comment&action=prepareUpdate&id=<?= $comment['id'] ?>">Zmien<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=comment&action=prepareDelete&id=<?= $comment['id'] ?>">Usun<a/>
        </div>
    <?php endforeach; ?>
<?php endif ?>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>