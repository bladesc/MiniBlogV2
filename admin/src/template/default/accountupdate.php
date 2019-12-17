<?php include 'pageup.php' ?>


<form action="index.php?pageadmin=account&action=update&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
    Dane podstawowe
    <div>
        Nick
        <input type="text" name="fNick" value="<?= $this->data['accounts']['user_nick'] ?>">
        Email
        <input type="email" name="fEmail" value="<?= $this->data['accounts']['user_email'] ?>">
        Haslo
        <input type="password" name="fPassword" value="">
        Potwierdz haslo
        <input type="password" name="fPasswordProve" value="">
        Status
        <select name="fStatus">
            <option value="1" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                Aktywny
            </option>
            <option value="2" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                Nieaktywny
            </option>
        </select>
    </div>
    Dane dodatkowe
    <div>
        Imie
        <input type="text" name="fFirstName" value="<?= $this->data['accounts']['user_details_firstname'] ?>">
        nazwisko
        <input type="text" name="fSurName" value="<?= $this->data['accounts']['user_details_surname'] ?>">
        data urodzenia
        <input type="date" name="fBirthDay" value="<?= $this->data['accounts']['user_details_birthday'] ?>" min="1890-01-01" max="2019-12-31">
    </div>
    Rola
    <div>
        Rola
    </div>
    <div>
        <select name="fRole">
            <?php print_r($this->data['roles']) ?>
            <?php foreach ($this->data['roles'] as $role): ?>
                <option value="<?= $role['id'] ?>" <?php if ($this->data['accounts']['user_role_id'] == $role['id']): ?> selected <?php endif; ?>>
                    <?= $role['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="hidden" name="fId" value="<?= $this->data['accounts']['user_id'] ?>">
        <input type="submit" name="fSubmit" value="Dodaj">
    </div>
</form>

<?php
print_r($this->data);
?>

<?php include 'pagedown.php' ?>

