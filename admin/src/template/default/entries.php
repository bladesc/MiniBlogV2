<?php include 'pageup.php' ?>
    <a href="index.php?pageadmin=entry&action=prepareCreate" class="button lightblue addnew">Dodaj nowy</a>
    <h1>Lista wpisów</h1>
    <table class="big">
        <thead>
            <tr>
                <td>Id</td>
                <td>Tytuł</td>
                <td>Treść</td>
                <td>Status</td>
                <td>Data utworzenia</td>
                <td>Kategoria</td>
                <td>Użytkownik</td>
                <td>Edytuj</td>
                <td>Usuń</td>
            </tr>
        </thead>
        <?php if (isset($this->data['entries'])) : ?>
            <?php foreach ($this->data['entries'] as $category): ?>
            <tbody>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['title'] ?></td>
                    <td><?= \src\core\helper\Helper::cut($category['content'],10) ?></td>
                    <td><?= $category['status'] ?></td>
                    <td><?= $category['created_at'] ?></td>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['nick'] ?></td>
                    <td>
                        <a href="index.php?pageadmin=entry&action=prepareUpdate&id=<?= $category['id'] ?>" class="button lightgrey">Edytuj<a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=entry&action=prepareDelete&id=<?= $category['id'] ?>" class="button lightgrey">Usun<a/>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
<?php include 'pagedown.php' ?>