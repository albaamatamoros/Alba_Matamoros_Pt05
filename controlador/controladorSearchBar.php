<?php
    //Alba Matamoros Morales
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Array d'errors.
    $errors = [];
    require_once '../model/modelPaginacio.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = ($_POST["action"]);
        try {
            if ($accion == "Cercar"){
                $personatgeNom = htmlspecialchars($_POST["personatge"]);

                //Control d'errors
                if (empty($personatgeNom)) {
                    
                }
            } else { 
                $errors[] = "No es pot completar aquesta acció.";
                include "../vista/vistaInserir.php"; 
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>