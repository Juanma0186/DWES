<?php

function obtenerUsuarioPorCorreo($conn, $correo)
{
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE correo_usuario = ?");
    $stmt->execute([$correo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function verificarToken($conn, $token, $email)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM token WHERE token = ? AND correo_usuario= ? AND fecha_expiracion > NOW()");
        $stmt->execute([$token, $email]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        throw new Exception("Error al verificar el token: " . $e->getMessage());
    }
}

function obtenerCorreoPorToken($conn, $token, $tipo)
{
    // Prepara la consulta SQL
    $stmt = $conn->prepare("SELECT correo_usuario  FROM token WHERE token = ? AND tipo=? AND fecha_expiracion> NOW()");
    $stmt->execute([$token, $tipo]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function verificarCookieRecuerdame($conn, $tipo)
{
    if (isset($_COOKIE['recuerdame'])) {
        $token = $_COOKIE['recuerdame'];
        $usuario = obtenerCorreoPorToken($conn, $token, $tipo);

        if ($usuario) {
            // El token es válido y corresponde a un usuario
            // Inicia sesión y almacena información del usuario
            session_start();
            $_SESSION['correo_usuario'] = $usuario['correo_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            setcookie('recuerdame', $token, time() + 60 * 60 * 24 * 7);

            return true;
        }
    }
    // La cookie 'recuerdame' no existe o el token no es válido
    return false;
}



function obtenerTokenPorTokenYFecha($db, $token)
{
    $stmt = $db->prepare("SELECT * FROM token WHERE token = ? AND fecha_expiracion > NOW()");
    $stmt->execute([$token]);
    return $stmt->fetch();
}

function eliminarToken($db, $token)
{
    $stmt = $db->prepare("DELETE FROM token WHERE token = ?");
    $stmt->execute([$token]);
}

function insertarToken($conn, $email, $token, $tipo,$minutos)
{
    $stmt = $conn->prepare("INSERT INTO token (correo_usuario, token, fecha_expiracion, tipo) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE), ?)");
    $stmt->execute([$email, $token, $minutos, $tipo]);
}


function actualizarContrasena($db, $hashed_password, $correo_usuario)
{
    $stmt = $db->prepare("UPDATE usuario SET contrasenia_usuario = ? WHERE correo_usuario = ?");
    $stmt->execute([$hashed_password, $correo_usuario]);
}

function verificarSiExisteUsuario($conn, $email)
{

    $stmt = $conn->prepare("SELECT correo_usuario FROM usuario WHERE correo_usuario = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function registrarUsuario($conn,  $email, $usuario, $hashed_password)
{

    $stmt = $conn->prepare("INSERT INTO usuario ( correo_usuario, nombre_usuario,contrasenia_usuario) VALUES (?, ?, ?)");
    $stmt->execute([$email, $usuario, $hashed_password]);
}

//? Verifica si el usuario ya ha usado la contraseña en sus últimas 3 contraseñas
function verificarContrasenaAnterior($db, $email, $nuevaContrasena)
{
    $contrasenasAnteriores = obtenerUltimasContrasenas($db, $email);

    foreach ($contrasenasAnteriores as $contrasenaAnterior) {
        if (password_verify($nuevaContrasena, $contrasenaAnterior)) {
            return true;
        }
    }

    return false;
}

//? Obtiene las últimas n contraseñas del usuario
function obtenerUltimasContrasenas($db, $email)
{
    $stmt = $db->prepare("SELECT contrasena_anterior FROM historial_contrasenas WHERE correo_usuario = ? ORDER BY fecha_cambio DESC LIMIT 3 ");
    $stmt->execute([$email]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $contrasenas = [];

    foreach ($result as $row) {
        $contrasenas[] = $row['contrasena_anterior'];
    }

    return $contrasenas;
}

//? Guarda la contraseña en el historial de contraseñas
function guardarContrasenaHistorial($conn, $correo, $hashed_password)
{
    $stmt = $conn->prepare("INSERT INTO historial_contrasenas (correo_usuario, contrasena_anterior, fecha_cambio) VALUES (?, ?, NOW())");
    $stmt->execute([$correo, $hashed_password]);
}


function generarCookie()
{
    setcookie('cookieUsuario', 'recuerdame');
}

function generarToken($bytes)
{
    $token = bin2hex(random_bytes($bytes));
    return $token;
}
