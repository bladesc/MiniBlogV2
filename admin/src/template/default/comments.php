<?php include 'pageup.php' ?>
    <h1>Lista komentarzy</h1>
    <table class="big">
        <thead>
        <tr>
            <td>Id</td>
            <td>Użytkownik</td>
            <td>Treść</td>
            <td>Id wpisu</td>
            <td>Edytuj</td>
            <td>Usuń</td>
        </tr>
        </thead>

        <?php if (isset($this->data['comments'])) : ?>
            <?php foreach ($this->data['comments'] as $comment): ?>
                <tbody>
                <tr>
                    <td><?= $comment['id'] ?></td>
                    <td><?= $comment['user_id'] ?></td>
                    <td><?= \src\core\helper\Helper::cut($comment['content'], 10) ?></td>
                    <td><?= $comment['entry_id'] ?></td>
                    <td>
                        <a href="index.php?pageadmin=comment&action=prepareUpdate&id=<?= $comment['id'] ?>"
                           class="button lightgrey">Zmien<a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=comment&action=prepareDelete&id=<?= $comment['id'] ?>"
                           class="button lightgrey">Usun<a/>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
<?php include 'pagedown.php' ?>