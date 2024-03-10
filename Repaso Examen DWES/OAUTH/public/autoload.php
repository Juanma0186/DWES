<?php

spl_autoload_register(function ($class_name) {
    $classPath = "../src/";
    require_once  $class_name . ".php";
});
