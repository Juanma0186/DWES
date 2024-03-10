<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<div class="menu">
  <a href="index.php">Inicio</a>
  <a href="admin.php">Admin</a>
  <a href="privado.php">Privado</a>
  <a href="login.php">Login</a>
  <a href="logout.php">Logout</a>
</div>
<div>
  <p>
    Nombre:
    <?php if (isset($_SESSION['username'])) { ?>
      <span>
        <?= $_SESSION['username'] ?>, <?= $_SESSION['grupo'] ?>
      </span>
    <?php } else { ?>
      Anónimo
    <?php } ?>
  </p>
</div>
