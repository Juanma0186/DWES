<?php

if (isset($_SESSION)) {
  $_SESSION = [];
  session_destroy();
}
header('Location: login.php');
exit();
