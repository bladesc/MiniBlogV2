<?php include 'pageup.php' ?>


<form action="index.php?pageadmin=account&action=create" method="post">
    Dane podstawowe
    <div>
        Nick
        <input type="text" name="fNick" value="<?= $this->request->post()->get('fNick') ?>">
        Email
        <input type="email" name="fEmail" value="<?= $this->request->post()->get('fEmail') ?>">
        Haslo
        <input type="password" name="fPassword" value="<?= $this->request->post()->get('fPassword') ?>">
        Potwierdz haslo
        <input type="password" name="fPasswordProve" value="<?= $this->request->post()->get('fPasswordProve') ?>">
        Status
        <select name="fStatus">
            <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                Aktywny
            </option>
            <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                Nieaktywny
            </option>
        </select>
    </div>
    Dane dodatkowe
    <div>
        Imie
        <input type="text" name="fFirstName" value="<?= $this->request->post()->get('fFirstName') ?>">
        nazwisko
        <input type="text" name="fSurName" value="<?= $this->request->post()->get('fSurName') ?>">
        data urodzenia
        <input type="date" name="fBirthDay" value="<?= $this->request->post()->get('fBirthDay') ?>" min="1890-01-01" max="2019-12-31">
    </div>
    Rola
    <div>
        Rola
    </div>
    <div>
        <select name="fRole">
            <?php foreach ($this->data['roles'] as $role): ?>
                <option value="<?= $role['id'] ?>" <?php if ($this->request->post()->get('fStatus') == $role['id']): ?> selected <?php endif; ?>>
                    <?= $role['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="submit" name="fSubmit" value="Dodaj">
    </div>
</form>

<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>

