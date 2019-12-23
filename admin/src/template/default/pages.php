<?php include 'pageup.php' ?>
    <a href="index.php?pageadmin=page&action=prepareCreate" class="button lightblue addnew">Dodaj nowy</a>
    <h1>Lista stron</h1>
    <table class="big">
        <thead>
        <tr>
            <td>Id</td>
            <td>Nazwa</td>
            <td>Url</td>
            <td>Treść</td>
            <td>Status</td>
            <td>Data stworzenia</td>
            <td>Data modyfikacji</td>
            <td>Seo tytuł</td>
            <td>Seo tagi</td>
            <td>Seo opis</td>
            <td>Edytuj</td>
            <td>Usuń</td>
        </tr>
        </thead>

        <?php foreach ($this->data['pages'] as $page): ?>
            <tbody>
            <tr>
                <td><?= $page['id'] ?></td>
                <td><?= $page['name'] ?></td>
                <td><?= $page['url'] ?></td>
                <td><?= \src\core\helper\Helper::cut($page['content'], 10) ?></td>
                <td><?= $page['status'] ?></td>
                <td><?= $page['created_at'] ?></td>
                <td><?= $page['updated_at'] ?></td>
                <td><?= \src\core\helper\Helper::cut($page['title'], 10) ?></td>
                <td><?= \src\core\helper\Helper::cut($page['description'], 10) ?></td>
                <td><?= $page['tag'] ?></td>
                <td>
                    <a href="index.php?pageadmin=page&action=prepareUpdate&id=<?= $page['id'] ?>"
                       class="button lightgrey">Edytuj<a/>
                </td>
                <td>
                    <a href="index.php?pageadmin=page&action=prepareDelete&id=<?= $page['id'] ?>"
                       class="button lightgrey">Usuń<a/>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
<?php include 'pagedown.php' ?>