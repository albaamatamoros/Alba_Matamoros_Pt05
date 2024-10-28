<?php
    //Alba Matamoros Morales
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Array d'errors.
    $errors = [];
    //Comprovar l'exsistencia d'un usuari.
    $exsist = false;
    //Comprovat si tot a estat ok.
    $correcte = "";
    //Guardem les dades del personatge en concret.
    $PersonatgeBD;
    require_once "../model/modelPersonatges.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = ($_POST["action"]);

        try {
            if ($accion == "Modificar") {
                $nom = htmlspecialchars($_POST["nom"]);
                $text = htmlspecialchars($_POST["text"]);
                $personatgeId = htmlspecialchars($_POST["id"]);

                //Control d'errors.
                if (empty($nom) && empty($text)) $errors[] = "➤ Nom i descripcio no poden ser buits.";

                if (empty($errors)) {
                    //Guardem el resultat del select, si no trova res retornara FALSE.
                    $existe = selectComprovarId($personatgeId);
                    if ($existe === false){
                        $errors[] = "➤ No existeix cap personatge amb aquest Id.";
                    } else {
                        $PersonatgeBD = selectPersonatgePerId($personatgeId);

                        if (empty($nom)) $errors = "➤ El camp nom no pot ser buit";
                        if (empty($text)) $errors = "➤ El camp descripcio no pot ser buit";
                    }
                    //Comprovem si s'ha generat algun error en el proces, sino s'envia un missatge dient que esta tot correcte. 
                    if (empty($errors)){
                        modificar($nom, $text, $personatgeId);
                        $correcte = "Personatge modificat correctament!";
                        unset($PersonatgeBD["nom"]);
                        unset($PersonatgeBD["cos"]);
                        header("Location: ../index.php" );
                    } else { include "../vista/vistaModificarDades.php"; }
                } else { include "../vista/vistaModificarDades.php"; }  
            } else {
                $errors[] = "No es pot completar aquesta acció.";
                include "../vista/vistaModificarDades.php"; 
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>