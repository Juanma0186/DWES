<?php
session_start();

if (!isset($_SESSION['correo']) && !isset($_SESSION['nombre'])) {
    header('Location: inicio_sesion.php');
    exit;
}

// if (!isset($_SESSION['correo_usuario']) && !isset($_SESSION['nombre_usuario'])) {
// 	// Almacena la URL actual en la sesión antes de redirigir
// 	$_SESSION['url_previa'] = $_SERVER['REQUEST_URI'];
// 	header('Location: inicio_sesion.php');
// 	exit();
// }


// $nombre = $_SESSION['nombre_usuario'];
// $correo = $_SESSION['correo_usuario'];
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];


?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>

	<title>Inicio</title>
</head>

<body class="bg-blue-200 min-h-screen">

	<div class="flex justify-end w-full px-6 py-4">
		<form action="cerrar_sesion.php" method="post">
			<button type="submit" name="cerrar_sesion" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600">
				Cerrar sesión
			</button>
		</form>
	</div>

	<div class="flex justify-center items-center ">
		<div class="container p-2 md:w-1/3">
			<div class="h-full border-2 border-gray-500 border-opacity-60 rounded-lg overflow-hidden">
				<img class="lg:h-48 md:h-36 w-full object-cover object-center" src="../img/auth.png" alt="blog">
				<div class="p-6">
					<h2 class="tracking-widest text-md title-font font-medium text-gray-400 mb-1">Bienvenido</h2>
					<h1 class="title-font text-3xl font-medium text-gray-900 mb-3"><?= $nombre ?></h1>
					<p class="leading-relaxed mb-3">¡Hola <?= $nombre ?>! Estás conectado con el correo <?= $correo ?>. Aquí puedes encontrar las últimas noticias y actualizaciones.</p>
					<div class="flex items-center flex-wrap">
						<a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0" href="perfil.php">Perfil
							<svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path d="M5 12h14"></path>
								<path d="M12 5l7 7-7 7"></path>
							</svg>
						</a>
						<span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
							<svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
								<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
								<circle cx="12" cy="12" r="3"></circle>
							</svg>100.2K
						</span>
						<span class="text-gray-400 inline-flex items-center leading-none text-sm">
							<svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
								<path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
							</svg>6000
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="text-gray-600 body-font ">
		<div class="container mx-auto flex px-5 py-8 md:flex-row flex-col items-center">
			<div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
				<h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Lorem ipsum dolor sit amet.
					<br class="hidden lg:inline-block">gluten listo para usar
				</h1>
				<p class="mb-8 leading-relaxed">La taza de cobre intenta con todas sus fuerzas verter freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
				<div class="flex justify-center">
					<button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Botón</button>
					<button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Botón</button>
				</div>
			</div>
			<div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
				<img class="object-cover object-center rounded" alt="hero" src="../img/php.png">
			</div>
		</div>
	</section>
</body>

</html>