<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=account&action=prepareCreate">Add new</a>
list of accounts
<?php if (isset($this->data['accounts'])) : ?>
    <?php foreach ($this->data['accounts'] as $account): ?>
        <div><?= $account['nick'] ?></div>h
        <div><?= $account['email'] ?></div>
        <div><?= $account['status'] ?></div>
        <div><?= $account['created_at'] ?></div>
        <div><?= $account['updated_at'] ?></div>
        <div><?= $account['firstname'] ?></div>
        <div><?= $account['surname'] ?></div>
        <div><?= $account['birthday'] ?></div>
        <div><?= $account['name'] ?></div>
        <div>
            <a href="index.php?pageadmin=account&action=prepareUpdate&id=<?= $account['id'] ?>">Zmien<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=account&action=prepareDelete&id=<?= $account['id'] ?>">Usun<a/>
        </div>
    <?php endforeach; ?>
<?php endif ?>
<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>

