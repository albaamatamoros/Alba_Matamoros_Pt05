<?php
    //Alba Matamoros Morales
    session_start();
    require_once "../model/modelPersonatges.php";

    //Comrpovem si ens arriba una id per GET, i esborrem el personatge.
    if (isset($_GET['id_personatge'])) {
        $idPersonatge = $_GET['id_personatge'];
    
        esborrarPerId($idPersonatge);
    
        header("Location: ../index.php?pagina=1");
    }
?>