<?php
    //Alba Matamoros Morales
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Array d'errors.
    $errors = [];
    //Comprovar l'exsistencia d'un usuari.
    $exsist = false;
    //Missatge confirmació.
    $correcte = "";
    require_once "../model/modelUsuaris.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = $_POST["action"];

        try {
            if ($accion == "Canviar Contrasenya"){

                $contrasenyaActual = (htmlspecialchars($_POST["contrasenya_actual"]));
                $novaContrasenya = (htmlspecialchars($_POST["nova_contrasenya"]));
                $confirmarContrasenya = (htmlspecialchars($_POST["confirmar_contrasenya"]));


                //CONTROL D'ERRORS
                //Obligatoris.
                if (empty($contrasenyaActual)) { $errors[] = "➤ El camp 'contrasenya_actual' és obligatori."; } 
                if (empty($novaContrasenya)) { $errors[] = "➤ El camp 'nova_contrasenya' és obligatori."; }
                if (empty($confirmarContrasenya)) { $errors[] = "➤ El camp 'confirmar_contrasenya' és obligatori."; }

                //Regex complir contrasenya.
                //Comprovar que siguin iguals o que no sigui la mateixa.
                elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/', $novaContrasenya)){ $errors[] = "El format de la contrasenya no és correcte."; }
                if ( $novaContrasenya != $confirmarContrasenya) { $errors[] = "➤ Nova contrasenya i confirmar contrasenya no son iguals."; }
                if ( $contrasenyaActual == $novaContrasenya) { $errors[] = "➤ Aquesta ja es la teva actual contrasenya."; }

                //Si errors es buit ->
                if (empty($errors)) {
                    //Agafem l'i usuari.
                    $usuariId = $_SESSION["loginId"];
                    //COMPROVEM CONTRASENYA I USUARI I MODIFIQUEM.
                    $existe = comprovarContrasenyaId($usuariId);
                    if ($existe == false) {
                        $errors[] = "➤ No existeix aquest usuari.";
                    } else { 
                        $correct = password_verify($contrasenyaActual, $existe['contrasenya']); 
                        if ($correct == false){
                            $errors[] = "➤ La contrasenya Actual no es correcta.";
                        } else {
                            //Si exsisteix l'usuari i la contrasenya es correcte, modifiquem.
                            //Cifrar contrasenya.
                            $contrasenyaCifrada = password_hash($novaContrasenya, PASSWORD_DEFAULT);
                            modificarContrasenya($contrasenyaCifrada, $usuariId);
                            $correcte = "➤ Contrasenya canviada correctament.";
                            include "../vista/vistaCanviContra.php";
                        }
                    }
                    if (!empty($errors)){ 
                        include "../vista/vistaCanviContra.php"; 
                    }
                } else { include "../vista/vistaCanviContra.php"; }
            } else { 
                $errors[] = "No es pot completar aquesta acció.";
                include "../vista/vistaCanviContra.php"; }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>