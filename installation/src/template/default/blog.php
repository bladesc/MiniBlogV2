<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>

<h1>Wypełnij poniższe dane</h1>

<form action="index.php?install_page=blog&action=addUser" method="post">
    <?php include 'layout/validationErrors.php' ?>
    <div class="box-input">
        <label for="bUserName"><?= $this->translations->pl['blogUser'] ?></label>
        <input type="text" name="bUserName" id="bUserName" value="<?= $this->request->post()->get('bUserName') ?>" required>
    </div>
    <div class="box-input">
        <label for="bUserEmail"><?= $this->translations->pl['blogEmail'] ?></label>
        <input type="email" name="bUserEmail" id="bUserEmail" value="<?= $this->request->post()->get('bUserEmail') ?>" required>
    </div>

    <div class="box-input">
        <label for="bUserPassword"><?= $this->translations->pl['blogPassword'] ?></label>
        <input type="password" name="bUserPassword" id="bUserPassword" value="<?= $this->request->post()->get('bUserPassword') ?>" required>
    </div>
    <div class="box-input">
        <label for="bUserPasswordProve"><?= $this->translations->pl['blogPasswordProve'] ?></label>
        <input type="password" name="bUserPasswordProve" id="bUserPasswordProve" value="<?= $this->request->post()->get('bUserPasswordProve') ?>" required>
    </div>
    <input type="submit" value="<?= $this->translations->pl['buttonNext'] ?>" class="lightblue button">
</form>

<?php include 'layout/footer.php' ?>