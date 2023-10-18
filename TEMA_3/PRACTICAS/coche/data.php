<?php

include("Coche.php");
include("CocheConRemolque.php");
include("CocheGrua.php");


//Creamos un array vacío
$coches = [];
//Cree un coche con matrícula 1000, marca BMV, carga 30
$bmv = new Coche("1000", "BMV", 30);
//Cree un coche con remolque y matrícula 1001, marca Renault, carga 30 y carga remolque 200
$renault = new CocheConRemolque("1001", "Renault", 30, 200);
//Cree un coche con matrícula 1002, marca Porche, carga 40
$porsche = new Coche("1002", "Porche", 40);
//Cree un coche-grúa con matrícula 1003, marca Ford, carga 20
$gruaFord = new CocheGrua("1003", "Ford", 20);
//Carga el Porche en el coche-grúa
$gruaFord->cargar($porsche);
//Crea otro coche con remolque: 1005, Nissan, 22, en el remolque 250
$nissan = new CocheConRemolque("1005", "Nissan", 22, 250);
//Crea otro coche grúa con matrícula 1007, Kia, carga 30
$gruaKia = new CocheGrua("1007", "Kia", 30);
//Carga el Nissan en la grúa
$gruaKia->cargar($nissan);
//Metemos en el array los coches que no tienen nada cargado
$coches = [$bmv, $renault, $gruaFord, $gruaKia];
//Utiliza array_walk para pintar en un div cada uno de los Coches
array_walk($coches, function ($coche) {
  echo "<div>$coche</div>";
});
