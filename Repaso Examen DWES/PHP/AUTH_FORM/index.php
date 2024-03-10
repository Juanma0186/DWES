<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

</body>
</html>
