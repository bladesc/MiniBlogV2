<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=category&action=prepareCreate" class="button lightblue addnew">Dodaj nowy</a>
<h1>Lista kateogrii</h1>
<table class="big">
    <thead>
    <tr>
        <td>Id</td>
        <td>Nazwa</td>
        <td>Status</td>
        <td>Edytuj</td>
        <td>Usuń</td>
    </tr>
    </thead>
    <?php foreach ($this->data['categories'] as $category): ?>
        <tbody>
        <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td><?= $category['status'] ?></td>
            <td>
                <a href="index.php?pageadmin=category&action=prepareUpdate&id=<?= $category['id'] ?>"
                   class="button lightgrey">Edytuj<a/>
            </td>
            <td>
                <a href="index.php?pageadmin=category&action=prepareDelete&id=<?= $category['id'] ?>"
                   class="button lightgrey">Usuń<a/>
            </td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>

<?php include 'pagedown.php' ?>



