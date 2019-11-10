<?php include 'layout/header.php' ?>
<?php include 'layout/breadcrump.php' ?>
Rozpocznij instalację
<?php

echo ($_SERVER['REQUEST_URI']);
?>
  <a href="index.php?install_page=database">Rozpocznij</a>
<?php

print_r($this->request->additional()->get());
print_r($this->data); ?>
<?php include 'layout/footer.php' ?>