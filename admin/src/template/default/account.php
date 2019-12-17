<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=account&action=prepareCreate">Add new</a>
list of accounts
<?php if (isset($this->data['accounts'])) : ?>
    <?php foreach ($this->data['accounts'] as $account): ?>
        <div><?= $account['user_nick'] ?></div>h
        <div><?= $account['user_email'] ?></div>
        <div><?= $account['user_status'] ?></div>
        <div><?= $account['user_created_at'] ?></div>
        <div><?= $account['user_updated_at'] ?></div>
        <div><?= $account['user_details_firstname'] ?></div>
        <div><?= $account['user_details_surname'] ?></div>
        <div><?= $account['user_details_birthday'] ?></div>
        <div><?= $account['user_role_name'] ?></div>
        <div>
            <a href="index.php?pageadmin=account&action=prepareUpdate&id=<?= $account['user_id'] ?>">Zmien<a/>
        </div>
        <div>
            <a href="index.php?pageadmin=account&action=prepareDelete&id=<?= $account['user_id'] ?>">Usun<a/>
        </div>
    <?php endforeach; ?>
<?php endif ?>
<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>

