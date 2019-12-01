<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>

Stara nazwa = asaf
    <form action="index.php?pageadmin=category&action=create" method="post">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="cName">
        </div>
        <div>
            <input type="submit" name="cCreate" value="Dodaj">
        </div>
    </form>

<?php include 'layout/sidebar.php' ?>
<?php include 'layout/footer.php' ?>