<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=account&action=prepareCreate" class="button lightblue addnew"><?= $this->translations->pl['buttonAddNew'] ?></a>
<h1><?= $this->translations->pl['userList'] ?></h1>
<table class="big">
    <thead>
    <tr>
        <td><?= $this->translations->pl['tableId'] ?></td>
        <td><?= $this->translations->pl['tableNick'] ?></td>
        <td><?= $this->translations->pl['tableEmail'] ?></td>
        <td><?= $this->translations->pl['tableStatus'] ?></td>
        <td><?= $this->translations->pl['tableDateC'] ?></td>
        <td><?= $this->translations->pl['tableDateM'] ?></td>
        <td><?= $this->translations->pl['tableFirstName'] ?></td>
        <td><?= $this->translations->pl['tableSurName'] ?></td>
        <td><?= $this->translations->pl['tableBirthDay'] ?></td>
        <td><?= $this->translations->pl['tableRole'] ?></td>
        <td><?= $this->translations->pl['tableEdit'] ?></td>
        <td><?= $this->translations->pl['tableDelete'] ?></td>
    </tr>
    </thead>
    <?php if (isset($this->data['accounts'])) : ?>
        <?php foreach ($this->data['accounts'] as $account): ?>
            <tbody>
            <tr>
                <td><?= $account['user_id'] ?></td>
                <td><?= $account['user_nick'] ?></td>
                <td><?= $account['user_email'] ?></td>
                <td><?= $account['user_status'] ?></td>
                <td><?= $account['user_created_at'] ?></td>
                <td><?= $account['user_updated_at'] ?></td>
                <td><?= $account['user_details_firstname'] ?></td>
                <td><?= $account['user_details_surname'] ?></td>
                <td><?= $account['user_details_birthday'] ?></td>
                <td><?= $account['user_role_name'] ?></td>
                <td>
                    <a href="index.php?pageadmin=account&action=prepareUpdate&id=<?= $account['user_id'] ?>"
                       class="button lightgrey"><?= $this->translations->pl['buttonChange'] ?><a/>
                </td>
                <td>
                    <a href="index.php?pageadmin=account&action=prepareDelete&id=<?= $account['user_id'] ?>"
                       class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    <?php endif ?>
</table>
<?php include 'pagedown.php' ?>

