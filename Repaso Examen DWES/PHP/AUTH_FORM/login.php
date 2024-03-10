<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    // $conn = new PDO('mysql:host=localhost;dbname=login', 'username', 'password');
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // // Preparar la consulta SQL
    // $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    // $stmt->bindParam(1, $username);
    // $stmt->bindParam(2, $password);

    // // Ejecutar la consulta
    // $stmt->execute();

    // Verificar si se encontró un usuario
    // if ($stmt->rowCount() > 0) {
    //     $_SESSION['username'] = $username;
    //     header('Location: index.php');
    //     exit;
    // } else {
    //     $error = 'Nombre de usuario o contraseña incorrectos.';
    // }


    // como no hay base de datos simulamos que el usuario es el que se indica
    if ($username && $password) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Nombre de usuario o contraseña incorrectos.';
    }

}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Iniciar sesión</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Nombre de usuario: <input type="text" name="username">
  <br><br>
  Contraseña: <input type="password" name="password">
  <br><br>
  <input type="submit" name="submit" value="Iniciar sesión">
</form>

<?php if (isset($error)): ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

</body>
</html>
