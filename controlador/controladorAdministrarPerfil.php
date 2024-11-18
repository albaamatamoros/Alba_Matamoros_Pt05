<?php
    // Alba Matamoros Morales

    // Iniciar la sesión si no se ha iniciado previamente
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Array para almacenar errores
    $errors = [];
    // Variable para comprobar si el usuario existe
    $exsist = false;
    // Mensaje de confirmación
    $correcte = "";
    // Variable para controlar si se están modificando los datos
    $modificarDades = false;

    require_once "../model/modelUsuaris.php";
?>
