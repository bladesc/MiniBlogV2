<?php include 'pageup.php' ?>

    <a href="index.php?pageadmin=gallery&action=prepareCreate" class="button lightblue addnew">Dodaj nowy</a>
    <h1>Lista galerii</h1>
    <table class="big">
        <thead>
        <tr>
            <td>Id</td>
            <td>Tytuł</td>
            <td>Treść</td>
            <td>Status</td>
            <td>Data utworzenia</td>
            <td>Kod html</td>
            <td>Użytkownik</td>
            <td>Edytuj</td>
            <td>Usuń</td>
        </tr>
        </thead>
        <?php if (isset($this->data['galleries'])) : ?>
            <?php foreach ($this->data['galleries'] as $gallery): ?>
                <tbody>
                <tr>
                    <td><?= $gallery['id'] ?></td>
                    <td><?= $gallery['name'] ?></td>
                    <td><?= $gallery['status'] ?></td>
                    <td><?= $gallery['created_at'] ?></td>
                    <td><?= $gallery['updated_at'] ?></td>
                    <td>
                        <%gallery=<?= $gallery['id'] ?>%>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=show&id=<?= $gallery['id'] ?>"
                           class="button lightgrey">Pokaz<a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=prepareUpdate&id=<?= $gallery['id'] ?>"
                           class="button lightgrey">Edytuj<a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=prepareDelete&id=<?= $gallery['id'] ?>"
                           class="button lightgrey">Usun<a/>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>

<?php include 'pagedown.php' ?>