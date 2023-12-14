<?php

require_once("data.php");

define("DIRECTORIO", "uploads/");
define('MAX_SIZE', 500000);
define("ALLOWED_TYPES", array("jpg", "png", "jpeg", "gif"));

$nombre = "";
$errores = [];
$subir = false;

// Conexión a la base de datos
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Capturar errores
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Comprobaciones de errores
if (isset($_POST["submit"])) {

    // Comprobamos si el nombre está vacío
    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $nombre = $_POST["name"];
    } else {
        $errores["nombre"] = "El nombre no puede estar vacío.";
        echo "El nombre no puede estar vacío.";
    }

    // Comprobaciones de la imagen
    if (isset($_FILES["imagen_perfil"])) {
        $archivo = DIRECTORIO . basename($_FILES["imagen_perfil"]["name"]);
        $nombreArchivo = basename($_FILES["imagen_perfil"]["name"]);
        $formatoImagen = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

        // Verifica si es una imagen real o una falsa
        $check = getimagesize($_FILES["imagen_perfil"]["tmp_name"]);
        if ($check !== false) {
            $subir = true;
        } else {
            echo "El archivo no es una imagen.";
            $subir = false;
        }

        // Si el archivo ya existe, añadir un número al nombre del archivo
        $contador = 1;
        while (file_exists($archivo)) {
            $nombreSinExtension = pathinfo($archivo, PATHINFO_FILENAME);
            $archivo = DIRECTORIO . $nombreSinExtension . "-" . $contador . "." . $formatoImagen;
            $contador++;
        }

        // Verifica el tamaño del archivo
        if ($_FILES["imagen_perfil"]["size"] > MAX_SIZE) {
            echo "Lo siento, el archivo es demasiado grande.";
            $subir = false;
        }

        // Verifica si los formatos de archivo son permitidos
        if (!in_array($formatoImagen, ALLOWED_TYPES)) {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $subir = false;
        }
    }
}

if (count($errores) > 0) {
    echo "Hubo errores en el formulario.";
} else {
    // Comprobamos si el nombre de usuario existe en la base de datos para poder asignarle la imagen
    $consulta = $db->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
    $consulta->bindParam(":nombre", $nombre);
    $consulta->execute();
    $resultado = $consulta->fetch();

    if ($resultado) {
        if ($subir && count($errores) == 0) {
            if (move_uploaded_file($_FILES["imagen_perfil"]["tmp_name"], $archivo)) {
                $sql = "UPDATE usuarios SET perfil_img = :path_img_perfil WHERE nombre = :nombre";
                $conn = $db->prepare($sql);
                $conn->bindValue(':path_img_perfil', $archivo);
                $conn->bindValue(':nombre', $nombre);

                if ($conn->execute()) {
                    echo "La imagen " . basename($_FILES["imagen_perfil"]["name"]) . " ha sido subida.";
                } else {
                    echo "Lo siento, hubo un error subiendo tu archivo.";
                }
            }
        }

        $db = null; // Cerrar conexión
    } else {
        echo "El usuario no existe.";
    }
}
