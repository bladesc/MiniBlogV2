<?php include 'pageup.php' ?>

<div id="section-login">
    <form method="post" action="index.php?page=change&action=processChange">
        <div>
            Stare haslo:
            <input type="password" name="fOldPassword">
        </div>
        <div>
            Nowe haslo:
            <input type="password" name="fNewPassword">
        </div>
        <div>
            Potwierdz nowe haslo
            <input type="password" name="fNewPasswordProve">
        </div>
        <div>
            Potwierdz nowe haslo
            <input type="submit" name="fChange">
        </div>

    </form>
</div>

<?php print_r($this->data); ?>
<?php include 'pagedown.php' ?>
