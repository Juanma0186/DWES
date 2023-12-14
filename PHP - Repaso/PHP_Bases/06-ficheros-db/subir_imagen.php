<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen de Perfil</title>
</head>

<body>
    <h1>Cambia tu imagen de perfil</h1>
    <form action="procesar_subida.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre:</label><input type="text" name="name" id="name"><br>
        <input type="file" name="imagen_perfil" id="imagen_perfil"><br>
        <input type="submit" value="Subir Imagen" name="submit">
    </form>

</body>

</html>
