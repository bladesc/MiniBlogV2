<?php include 'pageup.php' ?>

<h1>Lista logów</h1>
<table class="big">
    <thead>
    <tr>
        <td>Id</td>
        <td>Ades ip</td>
        <td>Data</td>
        <td>Id użytkownika</td>
        <td>Usuń</td>
    </tr>
    </thead>
    <?php foreach ($this->data['logs'] as $log): ?>
        <tbody>
        <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['ip'] ?></td>
            <td><?= $log['date'] ?></td>
            <td><?= $log['user_id'] ?></td>
            <td>
                <a href="index.php?pageadmin=log&action=prepareDelete&id=<?= $log['id'] ?>" class="button lightgrey">Usun<a/>
            </td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>

<?php include 'pagedown.php' ?>



