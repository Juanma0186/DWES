<?php

echo "<pre>";
print_r($_FILES);
echo "</pre>";

define("MAX_SIZE", 500000);
define("UPLOAD_DIR", "uploads/");
define("TARGET_FILE", UPLOAD_DIR . basename($_FILES["fileToUpload"]["name"]));
define("ALLOWED_TYPES", array("jpg", "png", "jpeg", "gif"));

$uploadOk = null;
$imageFileType = strtolower(pathinfo(TARGET_FILE, PATHINFO_EXTENSION));

//Verifica si el archivo es una imagen real
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

// Verifica si el archivo ya existe
if (file_exists(TARGET_FILE)) {
    echo "El archivo ya existe.";
    $uploadOk = 0;
}

//Verifica el tamaño del archivo
if ($_FILES["fileToUpload"]["size"] > MAX_SIZE) {
    echo "Lo siento, el archivo es demasiado grande.";
    $uploadOk = 0;
}

//Verifica los formatos de archivo permitidos
if (!in_array($imageFileType, ALLOWED_TYPES)) { //Si no encontramos el tipo de archivo
    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
    $uploadOk = 0;
}

//Verifica si $uploadOk es 0 por un error
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], TARGET_FILE)) {
        echo "La imagen " . basename($_FILES["fileToUpload"]["name"]) . " ha sido subida.";
    } else {
        echo "Lo siento, hubo un error subiendo tu archivo.";
    }
}
