 <?php  
    //Alba Matamoros Morales. 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../model/modelPaginacio.php';

    define("PAGINA", 1);
    //guardar els personatges per pagina.
    define("PERSONATGES_PER_PAGINA", isset($_COOKIE["personatgesCookie"]) ? $_COOKIE["personatgesCookie"] : 5);

    //Si es null, la pagina per defecte sera 1.
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    if (isset($_SESSION['loginId'])){
        define("USUARI_ID", $_SESSION['loginId']);
    }
    
    //CONSULTAR TODOS:  
    function retornarLinksConsultar($paginaActual = PAGINA){

        $mostrarPaginacio = "";
        
        $totalPersonatges = countPersonatges();
        $totalPagines = ceil($totalPersonatges / PERSONATGES_PER_PAGINA);

        // Evitar que la página actual exceda los límites
        if ($paginaActual < 1) {
            $paginaActual = 1;
        } elseif ($paginaActual > $totalPagines) {
            $paginaActual = $totalPagines;
        }

        //PAGINACIO BOTONS.
        //Boto Anterior.
        if ($paginaActual > 1){ $mostrarPaginacio .= sprintf("<a class='activat' href='vistaConsultar.php?pagina=%d'>Anterior</a>", $paginaActual - 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Anterior</a>"; }

        //Botons intermitjos, 1,2,3...
        for ($i = 1; $i <= $totalPagines; $i++ ){
            if ($i == $paginaActual){
                $mostrarPaginacio .= sprintf("<a class='desactivado'>%d</a>", $i);
            } else { $mostrarPaginacio .= sprintf("<a class='activat' href='vistaConsultar.php?pagina=%d'>%d</a>", $i, $i); }
        }

        //Boto Següent.
        if ($paginaActual < $totalPagines){ $mostrarPaginacio .= sprintf("<a class='activat' href='vistaConsultar.php?pagina=%d'>Següent</a>", $paginaActual + 1); }
        else { $mostrarPaginacio .= "<a class='desactivat'>Següent</a>"; }

        return $mostrarPaginacio;
    }

    //PAGINACIO DELS PERSONATGES GLOBAL.
    function paginacioGlobalConsultar($paginaActual = PAGINA){
        $mostrarPersonatges = "";

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