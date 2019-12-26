<?php include 'pageup.php' ?>

<h1><?= $this->translations->pl['h1LogList'] ?></h1>
<table class="big">
    <thead>
    <tr>
        <td><?= $this->translations->pl['tableId'] ?></td>
        <td><?= $this->translations->pl['tableIp'] ?></td>
        <td><?= $this->translations->pl['tableDateAt'] ?></td>
        <td><?= $this->translations->pl['tableIdUser'] ?></td>
        <td><?= $this->translations->pl['tableDelete'] ?></td>
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
                <a href="index.php?pageadmin=log&action=prepareDelete&id=<?= $log['id'] ?>" class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
            </td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>

<?php include 'pagedown.php' ?>



