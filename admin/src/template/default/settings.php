<?php include 'pageup.php' ?>
<a href="index.php?pageadmin=settings&action=prepareUpdate&id=<?= $this->data['settings'][0]['id'] ?>" class="button lightblue addnew">Edytuj<a/>
    <h1>Ustawienia</h1>
    <div id="box-settings">
        <div>
            Tytuł:
            <?= $this->data['settings'][0]['title'] ?>
        </div>
        <div>
            Opis:
            <?= $this->data['settings'][0]['description'] ?>
        </div>
        <div>
            Meta tagi:
            <?= $this->data['settings'][0]['meta_tags'] ?>
        </div>
    </div>

<?php include 'pagedown.php' ?>