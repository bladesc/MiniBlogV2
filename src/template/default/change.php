<?php include 'pageup.php' ?>

<h1>Zmiana hasła</h1>
<div id="section-login">
    <form method="post" action="index.php?page=change&action=processChange">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fOldPassword">Stare hasło:</label>
            <input type="password" class="medium" name="fOldPassword" id="fOldPassword">
        </div>
        <div>
            <label for="fNewPassword">Nowe hasło:</label>
            <input type="password" class="medium" name="fNewPassword" id="fNewPassword">
        </div>
        <div>
            <label for="fNewPasswordProve">Potwierdź nowe hasło:</label>
            <input type="password" class="medium" name="fNewPasswordProve" id="fNewPasswordProve">
        </div>
        <div>
            <input type="submit" name="fChange" id="fChange" value="Zmień" class="button lightgrey">
        </div>

    </form>
</div>

<?php include 'pagedown.php' ?>
