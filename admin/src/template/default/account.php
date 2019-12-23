<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=account&action=prepareCreate" class="button lightblue addnew">Dodaj nowy</a>
<h1>Lista Użytkowników</h1>
<table class="big">
    <thead>
    <tr>
        <td>Id</td>
        <td>Nick</td>
        <td>Email</td>
        <td>Status</td>
        <td>Data utworzenia</td>
        <td>Data utworzenia</td>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Data urodzin</td>
        <td>Rola</td>
        <td>Edytuj</td>
        <td>Usuń</td>
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
                       class="button lightgrey">Zmien<a/>
                </td>
                <td>
                    <a href="index.php?pageadmin=account&action=prepareDelete&id=<?= $account['user_id'] ?>"
                       class="button lightgrey">Usun<a/>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    <?php endif ?>
</table>
<?php include 'pagedown.php' ?>

