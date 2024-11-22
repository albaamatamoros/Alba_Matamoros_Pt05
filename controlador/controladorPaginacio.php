<?php
    //Alba Matamoros Morales.    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(str_contains($_SERVER['SCRIPT_NAME'], '/vista')) {
        require_once '../model/modelPaginacio.php';
    } else {
        require_once './model/modelPaginacio.php';
    }

    define("PAGINA", 1);
    //guardar els personatges per pagina.
    define("PERSONATGES_PER_PAGINA", isset($_COOKIE["personatgesCookie"]) ? $_COOKIE["personatgesCookie"] : 5);

    //-----------------------------------------
    //PAGINA ACTUAL + CALCUL PAGINES TOTALS.
    //Si es null, la pagina per defecte sera 1.
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    if (isset($_SESSION['loginId']) && !str_contains($_SERVER['SCRIPT_NAME'], '/vista')){
        $totalPersonatges = countPersonatgesPerUsuari($_SESSION['loginId']);
    } else {
        $totalPersonatges = countPersonatges();
    }

    $totalPagines = ceil($totalPersonatges / PERSONATGES_PER_PAGINA);

    // Evitar que la página actual exceda los límites
    if ($paginaActual < 1) {
        $paginaActual = 1;
    } elseif ($paginaActual > $totalPagines) {
        $paginaActual = $totalPagines;
    }
    //-----------------------------------------
    
    //CREAR ELS LINKS DE LA PAGINACIÓ PER USUARI.
    function retornarLinksPerUsuari(){
        global $paginaActual;
        global $totalPagines;

        $mostrarPaginacio = "";

        //PAGINACIO BOTONS.
        //Boto Anterior.
        if ($paginaActual > 1){ $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>Anterior</a>",$_SERVER['PHP_SELF'], $paginaActual - 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Anterior</a>"; }

        //Botons intermitjos, 1,2,3...
        for ($i = 1; $i <= $totalPagines; $i++ ){
            if ($i == $paginaActual){
                $mostrarPaginacio .= sprintf("<a class='desactivado'>%d</a>", $i);
            } else { $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>%d</a>",$_SERVER['PHP_SELF'], $i, $i); }
        }

        //Boto Següent.
        if ($paginaActual < $totalPagines){ $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>Següent</a>",$_SERVER['PHP_SELF'], $paginaActual + 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Següent</a>"; }

        return $mostrarPaginacio;
    }

    //PAGINACIO DELS PERSONATGES PROPIS D'UN USUARI.
    function paginacioPerUsuari(){
        global $paginaActual;

        $mostrarPersonatges = "";

        if ($paginaActual < 1) $paginaActual = 1;

        $personatges = consultarPerUsuariPaginacio($_SESSION['loginId'], $paginaActual, PERSONATGES_PER_PAGINA);

        if (!empty($personatges)) {
            foreach ($personatges as $personatge){
                $mostrarPersonatges .= sprintf(
                    '<div class="personatge-box">
                        <h2 class="personatge-nom">%s</h2>
                        <p class="personatge-cos">%s</p>
                        <div class="personatge-botons">
                            <a class="eliminar-btn" href="#" onclick="confirmarEsborrar(%s)">🗑️</a>
                            <a class="modificar-btn" href="vista/vistaModificarDades.php?id_personatge=%s">✏️</a>
                        </div>
                    </div>
                ', $personatge['nom'], $personatge['cos'], $personatge['id_personatge'], $personatge['id_personatge']);
            }
        } else {
            $mostrarPersonatges = '<p>No hi ha personatges disponibles.</p>';
        }

        return $mostrarPersonatges;
    }

    //CREAR ELS LINKS DE LA PAGINACIÓ GLOBAL.
    function retornarLinksGlobal(){
        global $paginaActual;
        global $totalPagines;

        $mostrarPaginacio = "";

        //PAGINACIO BOTONS.
        //Boto Anterior.
        if ($paginaActual > 1){ $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>Anterior</a>",$_SERVER['PHP_SELF'], $paginaActual - 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Anterior</a>"; }

        //Botons intermitjos, 1,2,3...
        for ($i = 1; $i <= $totalPagines; $i++ ){
            if ($i == $paginaActual){
                $mostrarPaginacio .= sprintf("<a class='desactivado'>%d</a>", $i);
            } else { $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>%d</a>",$_SERVER['PHP_SELF'], $i, $i); }
        }

        //Boto Següent.
        if ($paginaActual < $totalPagines){ $mostrarPaginacio .= sprintf("<a class='activat' href='%s?pagina=%d'>Següent</a>",$_SERVER['PHP_SELF'], $paginaActual + 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Següent</a>"; }

        return $mostrarPaginacio;
    }

    //PAGINACIO DELS PERSONATGES GLOBAL.
    function paginacioGlobal(){
        global $paginaActual;
        
        $mostrarPersonatges = "";

        if ($paginaActual < 1) $paginaActual = 1;

        $personatges = consultarPaginacio($paginaActual, PERSONATGES_PER_PAGINA);

        if (!empty($personatges)) {
            foreach ($personatges as $personatge){
                $mostrarPersonatges .= sprintf(
                    '<div class="personatge-box">
                        <h2 class="personatge-nom">%s</h2>
                        <p class="personatge-cos">%s</p>
                    </div>
                ', $personatge['nom'], $personatge['cos']);
            }
        } else {
            $mostrarPersonatges = '<p>No hi ha personatges disponibles.</p>';
        }

        return $mostrarPersonatges;
    }
?>