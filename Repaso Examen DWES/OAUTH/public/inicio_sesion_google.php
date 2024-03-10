<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once 'Database.php';

use League\OAuth2\Client\Provider\Google;

session_start(); // Remove if session.auto_start=1 in php.ini

$options = [
    'scope' => ['email', 'profile'], // los permisos que estás solicitando
    'prompt' => 'select_account', // fuerza al usuario a seleccionar una cuenta
];

$provider = new Google([
    'clientId'     => '236182600672-nlgn9a28tf11ss6q0hoakb4vuv08hul3.apps.googleusercontent.com',
    'clientSecret' => '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',
    'redirectUri'  => 'http://localhost:8080/public/inicio_sesion_google.php',
    // 'hostedDomain' => 'example.com', // optional; used to restrict access to users on your G Suite/Google Apps for Business accounts
]);

if (!empty($_GET['error'])) {

    // Got an error, probably user denied access
    exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
} elseif (empty($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    // State is invalid, possible CSRF attack in progress
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the owner details
        // Ahora tienes el token de acceso, puedes mirar los detalles del usuario
        $user = $provider->getResourceOwner($token);

        // Aquí es donde podrías empezar a interactuar con tu base de datos
        // Por ejemplo, podrías buscar al usuario por su ID de Google para ver si ya han iniciado sesión antes
        $userId = $user->getId();
        $nombre = $user->getFirstName();
        $email = $user->getEmail();
        // Obtén la instancia de la base de datos
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usuario WHERE correo_usuario = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetchAll();
        
        // Ahora puedes trabajar con los resultados de la consulta
        if (count($result) > 0) {
            // El usuario ya existe en tu base de datos, así que podrías actualizar su token de acceso
            $stmt = $db->prepare("UPDATE token SET token = :token WHERE correo_usuario = :email");
            $stmt->execute(['token' => $token, 'email' => $email]);
            $_SESSION['nombre'] = $nombre; 
            $_SESSION['correo'] = $email; 
        } else {
            // El usuario no existe en tu base de datos, así que podrías crear un nuevo registro para ellos
            $stmt = $db->prepare("INSERT INTO usuario (correo_usuario, nombre_usuario) VALUES (:email, :userId)");
            $stmt->execute(['email' => $email, 'userId' => $nombre]);

            $stmt = $db->prepare("INSERT INTO token (correo_usuario, token) VALUES (:email, :token)");
            $stmt->execute(['email' => $email, 'token' => $token]);
            $_SESSION['nombre'] = $nombre; 
            $_SESSION['correo'] = $email; 
        }
    } catch (Exception $e) {

        // Failed to get user details
        exit('Something went wrong: ' . $e->getMessage());
    }
}
// Redirige al usuario a index.php
header('Location: index.php');
exit();
?>