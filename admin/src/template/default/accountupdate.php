<?php include 'pageup.php' ?>

<h1>Edycja użytkownika</h1>
<form action="index.php?pageadmin=account&action=update&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
    <?php include 'layout/validationErrors.php' ?>
    <h3>Dane podstawowe</h3>
    <div>
        <label for="fNick">Nick</label>
        <input type="text" name="fNick" id="fNick" value="<?= $this->data['accounts']['user_nick'] ?>">
    </div>
    <div>
        <label for="fEmail">Adres e-mail</label>
        <input type="email" name="fEmail" id="fEmail" value="<?= $this->data['accounts']['user_email'] ?>">
    </div>
    <div>
        <label for="fPassword">Hasło</label>
        <input type="password" id="fPassword" name="fPassword" value="">
    </div>
    <div>
        <label for="fPasswordProve">Potwierdź hasło</label>
        <input type="password" name="fPasswordProve" id="fPasswordProve" value="">
    </div>
    <div>
        <label for="fStatus">Status</label>
        <select name="fStatus" id="fStatus">
            <option value="1" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                Aktywny
            </option>
            <option value="2" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                Nieaktywny
            </option>
        </select>
    </div>

    <h3>Dane dodatkowe</h3>
    <div>
        <label for="fFirstName">Imię</label>
        <input type="text" name="fFirstName" id="fFirstName"
               value="<?= $this->data['accounts']['user_details_firstname'] ?>">
    </div>
    <div>
        <label for="fSurName">Nazwisko</label>
        <input type="text" name="fSurName" id="fSurName" value="<?= $this->data['accounts']['user_details_surname'] ?>">
    </div>
    <div>
        <label for="fBirthDay">Data urodzin</label>
        <input type="date" name="fBirthDay" id="fBirthDay"
               value="<?= $this->data['accounts']['user_details_birthday'] ?>"
               min="1890-01-01" max="2019-12-31">
    </div>

    <h3>Uprawnienia</h3>
    <div>
        <label for="fRole">Rola</label>
        <select name="fRole" id="fRole">
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
        <input type="submit" name="fSubmit" value="Edytuj" class="button lightblue">
    </div>
</form>

<?php include 'pagedown.php' ?>

