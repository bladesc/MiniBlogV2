<?php include 'pageup.php' ?>

<h1>Logowanie</h1>
<div id="section-login">
    <form method="post" action="index.php?page=login&action=processLogin">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fEmail">Adres e-mail:</label>
            <input type="email" name="fEmail" id="fEmail" class="medium">
        </div>
        <div>
            <label for="fPassword">Hasło:</label>
            <input type="password" name="fPassword" id="fPassword" class="medium">
        </div>
        <div>
            <input type="submit" name="fLogin" class="button lightgrey" value="Zaloguj">
        </div>
    </form>
    <a href="index.php?page=register" class="standard">Zarejestruj</a>
    <a href="index.php?page=remind" class="standard">Przypomnij haslo</a>
</div>

<?php include 'pagedown.php' ?>
