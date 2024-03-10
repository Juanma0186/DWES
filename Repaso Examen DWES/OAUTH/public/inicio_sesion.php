<?php

include 'autoload.php';
include 'funciones.php';
session_start();
//? Variables para almacenar la contraseña y los errores
$exito = [];
$correo = '';
$contraseña = '';
$error = [];
const TIPO = 'recuerdame';
const MINUTOS = 60 * 24 * 7;
const UNA_SEMANA_EN_SEGUNDOS = 60 * 60 * 24 * 7;

//? Obtiene una instancia de la base de datos
$conn = Database::getInstance();


if (verificarCookieRecuerdame($conn, TIPO)) {
    header("Location: index.php");
    exit();
}


//? Verifica si hay un mensaje de éxito y un correo en la sesión para pintarlo en el form al usuario
if (isset($_SESSION['mensaje_exito']) && isset($_SESSION['correo'])) {
    $exito['registro'] = $_SESSION['mensaje_exito'];
    $correo = $_SESSION['correo'];
    session_unset();
}
//? Mensaje si hay exito en el cambiode la contraseña
if (isset($_SESSION['contraseña_restablecida'])) {
    $contraseña_restablecida['contraseña_restablecida'] = $_SESSION['contraseña_restablecida'];
    session_unset();
}

//? Verifica si se envió el formulario de inicio de sesión
if (isset($_POST['inicio'])) {

    //? Valida la existencia y no vacío del campo 'correo' y 'contraseña'
    if (!isset($_POST['correo']) || empty($_POST['correo'])) {
        $error['correo'] = 'Correo obligatorio';
    } else {
        $correo = $_POST['correo'];
    }
    if (!isset($_POST['contraseña']) || empty($_POST['contraseña'])) {
        $error['contraseña'] = 'Contraseña obligatoria';
    } else {
        $contraseña = $_POST['contraseña'];
    }

    if (isset($_POST['recuerdame'])) {
        $recuerdame = $_POST['recuerdame'];
    }

    //? Si no hay errores, procede a validar las credenciales
    if (empty($error)) {

        $usuario = obtenerUsuarioPorCorreo($conn, $correo);

        //? Verifica si el usuario existe y la contraseña es válida
        if ($usuario && password_verify($contraseña, $usuario['contrasenia_usuario'])) {

            if (isset($_POST['recuerdame'])) {

                $token = generarToken(20);
                insertarToken($conn, $correo, $token, TIPO, MINUTOS);
                setcookie('recuerdame', $token, time() + UNA_SEMANA_EN_SEGUNDOS);
                session_start();
                $_SESSION['correo_usuario'] = $usuario['correo_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            }

            //? Inicia sesión y almacena información del usuario
            session_start();
            $_SESSION['correo_usuario'] = $usuario['correo_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];

            //? Comprueba si existe una URL previa almacenada en la sesión
            if (isset($_SESSION['url_previa'])) {
                $url_previa = $_SESSION['url_previa'];
                unset($_SESSION['url_previa']);  //? Elimina la URL previa de la sesión
                header("Location: $url_previa");  //? Redirige a la URL previa
                exit();
            }

            //? si no hay url previa redirige a la página de inicio
            header("Location: index.php");
            exit();
        } else {
            $error['credenciales'] = "Credenciales incorrectas";
        }
    }

    $conn->cerrarConexion();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Inicio Sesión</title>
</head>

<body style="background-image: url('../img/auth.png'); " class="relative flex items-center w-screen h-screen bg-center bg-no-repeat bg-cover font-poppins ">

    <div class="absolute top-0 left-0 w-screen h-screen bg-black opacity-80"></div>
    <div class="relative flex flex-col w-full gap-4 px-4 py-6 mx-auto text-center text-white border-2 rounded-md shadow-xl md:w-1/2 lg:w-1/3 xl:w-1/4 2xl:w-1/5 shadow-blue-500">
        <h1 class="text-2xl font-semibold uppercase">Inicio Sesión</h1>
        <form action="" method="post">
            <div class="flex flex-col w-full gap-2 mx-auto md:w-3/4">
                <label class="text-xl font-semibold text-left" for="">Correo</label>
                <input name="correo" value="<?= $correo  ?>" class="px-4 py-2 text-white transition duration-500 ease-in-out bg-transparent border-2 rounded-full outline-none focus:border-blue-500" type="text" placeholder="Ingresa tu usuario">
                <span class="text-red-600 font-bold"> <?= isset($error['correo']) ? $error['correo']  : ''   ?> </span>
            </div>
            <div class="flex flex-col w-full gap-2 mx-auto md:w-3/4">
                <label class="text-xl font-semibold text-left" for="">Contraseña</label>
                <input name="contraseña" value="<?= $contraseña  ?>" class="px-4 py-2 text-white transition duration-500 ease-in-out bg-transparent border-2 rounded-full outline-none focus:border-blue-500" type="password" placeholder="Ingresa tu contraseña">
                <span class="text-red-600 font-bold"> <?= isset($error['contraseña']) ? $error['contraseña']  : ''   ?> </span>

            </div>
            <div class="flex items-center gap-4 mx-auto text-md mb-3">
                <input type="checkbox" name="recuerdame" value="recuerdame" id="recuerdame" <?= (isset($_POST['recuerdame']) ? 'checked' : '') ?>>
                <label for="recuerdame">Recuerdame</label>
                <a class="hover:underline" href="recuperar_contrasena.php">¿Has olvidado contraseña?</a>
            </div>
            <button type="submit" name="inicio" class="w-full px-4 py-2 mb-4 mx-auto text-xl bg-blue-700 border-2 border-blue-500 rounded-md md:w-1/2 hover:bg-transparent hover:border-blue-600">
                Iniciar
            </button><br>
            <span class="text-red-600 font-bold"><?= isset($error['credenciales']) ? $error['credenciales']  : ''  ?></span>
            <span class="text-green-600 font-bold"><?= isset($exito['registro']) ? $exito['registro'] : ''  ?></span>
            <span class="text-green-600 font-bold"><?= isset($contraseña_restablecida['contraseña_restablecida']) ? $contraseña_restablecida['contraseña_restablecida'] : ''  ?></span>

            <a href=""><i class='bx bxl-github bx-lg cursor-pointer hover:text-gray-700'></i></a>
            <a href="inicio_sesion_google.php"><i class='bx bxl-google bx-lg cursor-pointer hover:text-red-500'></i></a>
            <a href=""><i class='bx bxl-facebook-circle bx-lg cursor-pointer hover:text-blue-600'></i></a>
        </form>
        <p class="mt-4 text-md">¿No tienes una cuenta? <a href="registro.php" class="text-blue-500 underline">Regístrate aquí</a></p>
    </div>
</body>







</html>