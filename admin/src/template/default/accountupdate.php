<?php include 'pageup.php' ?>

<h1><?= $this->translations->pl['h1EditingUser'] ?></h1>
<form action="index.php?pageadmin=account&action=update&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
    <?php include 'layout/validationErrors.php' ?>
    <h3><?= $this->translations->pl['h3BasicData'] ?></h3>
    <div>
        <label for="fNick"><?= $this->translations->pl['blogUser'] ?></label>
        <input type="text" name="fNick" id="fNick" value="<?= $this->data['accounts']['user_nick'] ?>">
    </div>
    <div>
        <label for="fEmail"><?= $this->translations->pl['blogEmail'] ?></label>
        <input type="email" name="fEmail" id="fEmail" value="<?= $this->data['accounts']['user_email'] ?>">
    </div>
    <div>
        <label for="fPassword"><?= $this->translations->pl['blogPassword'] ?></label>
        <input type="password" id="fPassword" name="fPassword" value="">
    </div>
    <div>
        <label for="fPasswordProve"><?= $this->translations->pl['blogPasswordProve'] ?></label>
        <input type="password" name="fPasswordProve" id="fPasswordProve" value="">
    </div>
    <div>
        <label for="fStatus"><?= $this->translations->pl['blogStatus'] ?></label>
        <select name="fStatus" id="fStatus">
            <option value="1" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                <?= $this->translations->pl['blogStatusActive'] ?>
            </option>
            <option value="2" <?php if ($this->data['accounts']['user_status'] == 1): ?> selected <?php endif; ?>>
                <?= $this->translations->pl['blogStatusInactive'] ?>
            </option>
        </select>
    </div>

    <h3><?= $this->translations->pl['h3AdditionalData'] ?></h3>
    <div>
        <label for="fFirstName"><?= $this->translations->pl['blogFirstName'] ?></label>
        <input type="text" name="fFirstName" id="fFirstName"
               value="<?= $this->data['accounts']['user_details_firstname'] ?>">
    </div>
    <div>
        <label for="fSurName"><?= $this->translations->pl['blogSurName'] ?></label>
        <input type="text" name="fSurName" id="fSurName" value="<?= $this->data['accounts']['user_details_surname'] ?>">
    </div>
    <div>
        <label for="fBirthDay"><?= $this->translations->pl['blogBirthDay'] ?></label>
        <input type="date" name="fBirthDay" id="fBirthDay"
               value="<?= $this->data['accounts']['user_details_birthday'] ?>"
               min="1890-01-01" max="2019-12-31">
    </div>

    <h3><?= $this->translations->pl['h3credentials'] ?></h3>
    <div>
        <label for="fRole"><?= $this->translations->pl['blogRole'] ?></label>
        <select name="fRole" id="fRole">
            <?php foreach ($this->data['roles'] as $role): ?>
                <option value="<?= $role['id'] ?>" <?php if ($this->data['accounts']['user_role_id'] == $role['id']): ?> selected <?php endif; ?>>
                    <?= $role['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="hidden" name="fId" value="<?= $this->data['accounts']['user_id'] ?>">
        <input type="submit" name="fSubmit" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightblue">
    </div>
</form>

<?php include 'pagedown.php' ?>

