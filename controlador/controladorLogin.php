<?php
    //Alba Matamoros Morales
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Array d'errors.
    $errors = [];
    //Comprovar l'exsistencia d'un usuari.
    $exsist = false;
    //Si es correcta la contrasenya.
    $correct = "false";
    require_once "../model/modelUsuaris.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = ($_POST["action"]);
        try {
            if ($accion == "Iniciar sessió"){
                $usuari = htmlspecialchars(($_POST["usuari"]));
                $contrasenya = htmlspecialchars(($_POST["contrasenya"]));

                //Comprovar dades.
                if (empty($usuari)) { $errors[] = "➤ No pots iniciar sessió amb un usuari buit."; } 
                if (empty($contrasenya)) { $errors[] = "➤ Et cal una contrasenya per iniciar sessió.";}
                if (empty($errors)) {
                    //COMPROVAR USUARI I CONTRASENYA.
                    $existe = comprovarExistensiaDUsuari($usuari);
                    if ($existe == false) {
                        $errors[] = "➤ No existeix aquest usuari";
                    } else { 
                        $correct = password_verify($contrasenya, $existe['contrasenya']); 
                        if ($correct == false){
                            $errors[] = "➤ La contrasenya no es correcta";
                        } else {
                            $result = iniciSessio($usuari);
                            $_SESSION["loginId"] = $result["id_usuari"];
                            $_SESSION["loginUsuari"] = $result["usuari"];
                            $_SESSION["loginCorreu"] = $result["correu"];
                            $_SESSION["loginNom"] = $result["nom"];
                            $_SESSION["loginCognom"] = $result["cognoms"];
                            header("Location: ../index.php");
                        }
                    }
                    if (!empty($errors)){ include "../vista/vistaLogin.php"; }
                } else { include "../vista/vistaLogin.php"; }
            } else { 
                $errors[] = "No es pot completar aquesta acció.";
                include "../vista/vistaLogin.php"; }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>