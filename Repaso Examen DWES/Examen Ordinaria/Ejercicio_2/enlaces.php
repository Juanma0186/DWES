<?php

/*
¡¡¡¡ESTE ARCHIVO NO SE TOCA!!!!




*/

$dbname='examen';
$user='examen';
$password='examen';

try {
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
    );
    $dbh = new PDO($dsn, $user, $password);
    
} catch (PDOException $e){
    echo $e->getMessage();
}

$consulta = $dbh->query("SELECT * FROM auth_tokens");
$tokens = $consulta->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de enlaces</title>
</head>
<body>
    <h1>Esta página genera los enlaces necesarios para continuar con el ejercicio</h1>
    <h3>No debes modificarla</h3>
    <p>
        <?php foreach($tokens as $token) { ?>
            <a href="login.php?token=<?=$token['token']?>">Auth <?=$token['id']?> del user <?=$token['id_user']?></a><br>
        <?php } ?>
    </p>
</body>
</html>

