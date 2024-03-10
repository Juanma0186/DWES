<?php

//cerrar sesion
session_start();
session_destroy();
header("Location: iniciar_sesion.php");
?>