<h1>Wypełnij poniższe dane</h1>


<form action="index.php?install_page=blog&action=addUser" method="post">
    <div class="box-input">
        Name
        <input type="text" name="bUserName" value="<?= $this->request->post()->get('bUserName') ?>" required>
    </div>
    <div class="box-input">
        Email
        <input type="email" name="bUserEmail" value="<?= $this->request->post()->get('bUserEmail') ?>" required>
    </div>
        Haslo
    <div class="box-input">
        <input type="password" name="bUserPassword" value="<?= $this->request->post()->get('bUserPassword') ?>" required>
        Potwierdz haslo
    </div>
    <div class="box-input">
        <input type="password" name="bUserPasswordProve" value="<?= $this->request->post()->get('bUserPasswordProve') ?>" required>
    </div>
    <input type="submit" value="Dalej">

    <?php
    print_r($this->data);
    ?>
</form>