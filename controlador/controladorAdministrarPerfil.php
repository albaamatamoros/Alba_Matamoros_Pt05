<?php
    // Alba Matamoros Morales
    // Iniciar la sesión si no se ha iniciado previamente
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../model/modelUsuaris.php";

    // Array para almacenar errores
    $errors = [];
    // Variable para comprobar si el usuario existe
    $exsist = false;
    // Mensaje de confirmación
    $correcte = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = ($_POST["action"]);
        try {
            switch ($accion) {
                case "Guardar canvis":
                    //CANVIAR USUARIO:
                    $nomUsuari = htmlspecialchars($_POST["username"]);
                    $usuariId = htmlspecialchars($_SESSION["loginId"]);

                    if (empty($nomUsuari)) {
                        $errors[] = "➤ El camp usuari es obligatori i no es pot deixar buit."; 
                    }

                    if ($_FILES["arxiu"]["name"] == "" && $nomUsuari == $_SESSION["loginUsuari"]) {
                        $errors[] = "➤ No s'ha fet cap canvi.";
                    }

                    if (empty($errors)) {
                        // Comprobar si el nombre de usuario ya existe
                        $exsist = comprovarNomUsuariExistent($nomUsuari, $_SESSION["loginId"]);
                        if ($exsist != false) {
                            $errors[] = "➤ Ja existeix un usuari amb aquest nom.";
                        } else {
                            // Si no hay errores, modificar el nombre de usuario
                            $_SESSION["loginUsuari"] = $nomUsuari;
                            modificarNomUsuari($nomUsuari, $usuariId);
                            $correcte = "➤ Usuari modificat correctament.";
                        }
                    }

                    // CANVIAR/AFEGIR IMATGE:
                    if ($_FILES["arxiu"]["name"] != "") {
                        if ($_FILES['arxiu']['error'] == 0) {
                            // Obtener detalles de la imagen
                            $nomImatge = $_FILES['arxiu']['name'];
                            $tipusImatge = $_FILES['arxiu']['type'];
                            $directoriTemporalImatge = $_FILES['arxiu']['tmp_name']; 

                            // Carpeta de destino para la imagen
                            $directoriDestiImatge = '../vista/imatges/imatgesUsers/';
                            $nomUnic = uniqid() . "_" . basename($nomImatge);

                            // Mover el archivo al directorio de destino
                            if (move_uploaded_file($directoriTemporalImatge, $directoriDestiImatge . $nomUnic)) {
                                // Guardar la URL de la imagen
                                $urlImatge = $directoriDestiImatge . $nomUnic;
                                modificarImatgePerfilUsuari($urlImatge, $usuariId);
                                $_SESSION["loginImage"] = $urlImatge;
                                $correcte = "➤ Usuari modificat correctament.";
                            } else {
                                $errors[] = "➤ Error al pujar la imatge.";
                            }
                        } else {
                            $errors[] = "➤ Error al pujar la imatge.";
                        }
                    }

                    // Mostrar los errores y/o el mensaje de éxito
                    if (!empty($errors)) {
                        // Incluir la vista de perfil con los errores
                        include "../vista/vistaPerfil.php"; 
                    } else {
                        // Si no hay errores, mostrar el mensaje de éxito
                        include "../vista/vistaPerfil.php"; 
                    }
                    break;
                case "Canviar Contrasenya":
                    //CANVIAR CONTRASENYA:
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
                    elseif ( $novaContrasenya != $confirmarContrasenya) { $errors[] = "➤ Nova contrasenya i confirmar contrasenya no son iguals."; }
                    elseif ( $contrasenyaActual == $novaContrasenya) { $errors[] = "➤ Aquesta ja es la teva actual contrasenya."; }

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
                    break;
                default:
                    //SI NO AGAFA CAP DADA:
                    $errors[] = "No es pot completar aquesta acció.";
                    include "../vista/vistaPerfil.php";
                    break;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
