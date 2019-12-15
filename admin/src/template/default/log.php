<?php include 'pageup.php' ?>

logi

<?php foreach ($this->data['logs'] as $log): ?>
    <div><?= $log['id'] ?></div>
    <div><?= $log['ip'] ?></div>
    <div><?= $log['date'] ?></div>
    <div><?= $log['user_id'] ?></div>
    <div>
        <a href="index.php?pageadmin=log&action=prepareDelete&id=<?= $log['id'] ?>">Usun<a/>
    </div>
<?php endforeach; ?>

<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>



