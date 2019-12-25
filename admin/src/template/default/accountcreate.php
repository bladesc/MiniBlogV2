<?php include 'pageup.php' ?>

<h1>Dodawanie użytkownika</h1>
<div>
    <form action="index.php?pageadmin=account&action=create" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <h3>Dane podstawowe</h3>
        <div>
            <label for="fNick">Nick</label>
            <input type="text" name="fNick" id="fNick" value="<?= $this->request->post()->get('fNick') ?>">
        </div>
        <div>
            <label for="fEmail">Adres e-mail</label>
            <input type="email" name="fEmail" id="fEmail" value="<?= $this->request->post()->get('fEmail') ?>">
        </div>
        <div>
            <label for="fPassword">Hasło</label>
            <input type="password" name="fPassword" id="fPassword"
                   value="<?= $this->request->post()->get('fPassword') ?>">
        </div>
        <div>
            <label for="fPasswordProve">Potwierdź hasło</label>
            <input type="password" name="fPasswordProve" id="fPasswordProve"
                   value="<?= $this->request->post()->get('fPasswordProve') ?>">
        </div>
        <div>
            <label for="fStatus">Status</label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>

        <h3>Dane dodatkowe</h3>
        <div>
            <label for="fFirstName">Imię</label>
            <input type="text" name="fFirstName" id="fFirstName"
                   value="<?= $this->request->post()->get('fFirstName') ?>">
        </div>
        <div>
            <label for="fSurName">Nazwisko</label>
            <input type="text" name="fSurName" id="fSurName" value="<?= $this->request->post()->get('fSurName') ?>">
        </div>
        <div>
            <label for="fBirthDay">Data urodzin</label>
            <input type="date" name="fBirthDay" id="fBirthDay" value="<?= $this->request->post()->get('fBirthDay') ?>"
                   min="1890-01-01"
                   max="2019-12-31">
        </div>
        <h3>Uprawnienia</h3>
        <div>
            <label for="fRole">Rola</label>
            <select name="fRole" id="fRole">
                <?php foreach ($this->data['roles'] as $role): ?>
                    <option value="<?= $role['id'] ?>" <?php if ($this->request->post()->get('fStatus') == $role['id']): ?> selected <?php endif; ?>>
                        <?= $role['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="submit" name="fSubmit" value="Dodaj" class="button lightblue">
        </div>
    </form>
</div>

<?php include 'pagedown.php' ?>

