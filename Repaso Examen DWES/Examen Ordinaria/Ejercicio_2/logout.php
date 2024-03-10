<?php

unset($_SESSION['email']);

if (isset($_SESSION)) {
  session_destroy(); // Destruye la sesión
}

$_SESSION = [];

header('Location: login.php');
exit();
