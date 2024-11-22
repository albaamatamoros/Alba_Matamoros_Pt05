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
    $PersonatgeBD;
    require_once "../model/modelUsuaris.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = ($_POST["action"]);
        try {
            if ($accion === "Guardar canvis") {
                $nomUsuari = htmlspecialchars($_POST["username"]);
                $usuariId = htmlspecialchars($_SESSION["loginId"]);

                if (empty($nomUsuari)) $errors[] = "➤ El camp usuari es obligatori i no es pot deixar buit."; 
                if ($nomUsuari == $_SESSION["loginUsuari"]) $errors[] = "➤ No pots posar el mateix nom d'usuari.";

                //Control d'errors.
                if (empty($errors)) {
                    //Si la consulta retorna alguna valor significa que existeix un altre usuari amb aquest nom d'usuari.
                    $exsist = comprovarNomUsuariExistent($nomUsuari, $_SESSION["loginId"]);
                    if ($exsist != false) {
                        $errors[] = "➤ Ja existeix un usuari amb aquest nom.";
                    } else {
                        //Si no hi ha errors, modifiquem les dades.
                        $_SESSION["loginUsuari"] = $nomUsuari;
                        modificarNomUsuari($nomUsuari, $usuariId);
                        $correcte = "➤ Usuari modificat correctament.";
                        include "../vista/vistaPerfil.php";                   
                    }
                    if (!empty($errors)){ include "../vista/vistaPerfil.php"; }
                } else { include "../vista/vistaPerfil.php"; }
            } else { 
                $errors[] = "No es pot completar aquesta acció.";
                include "../vista/vistaPerfil.php"; 
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
