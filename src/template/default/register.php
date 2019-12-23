<?php include 'pageup.php' ?>

    <h1>Rejestracja</h1>
    <div id="section-register">
        <form method="post" action="index.php?page=register&action=create">
            <?php include 'layout/validationErrors.php' ?>
            <div>
                <label for="fNick">Nick:</label>
                <input type="text" name="fNick" id="fNick" class="medium">
            </div>
            <div>
                <label for="fEmail">Adres e-mail:</label>
                <input type="email" name="fEmail" id="fEmail" class="medium">
            </div>
            <div>
                <label for="fPassword">Hasło:</label>
                <input type="password" name="fPassword" id="fPassword" class="medium">
            </div>
            <div>
                <label for="fPasswordProve">Potwierdź hasło:</label>
                <input type="password" name="fPasswordProve" id="fPasswordProve" class="medium">
            </div>
            <div>
                <input type="submit" name="fAdd" class="button lightgrey" value="Zarejestruj">
            </div>
        </form>
        <a href="index.php?page=login" class="standard">Zaloguj</a>
        <a href="index.php?page=remind" class="standard">Przypomnij haslo</a>
    </div>

<?php include 'pagedown.php' ?>