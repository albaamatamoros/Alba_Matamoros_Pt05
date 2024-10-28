<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Alba Matamoros Morales -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estils/estilMenuPersonatges.css">
        <link rel="stylesheet" href="../estils/estilBarra.css">
        <title>Gestió de Personatges</title>
    </head>
    <body>
        <?php
            //Verificar si la sessió no està activa. (Comprovació perquè no s'intenti accedir mitjançant ruta).
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION["loginId"])) { header("Location: ../index.php" );}
        ?>
        <nav>
            <!-- INICI y GESTIÓ D'ARTICLES -->
            <div class="left">
                <a href='../index.php'">INICI</a>
                <a href="../vista/vistaMenu.php">GESTIÓ DE PERSONATGES</a>
            </div>

            <!-- PERFIL -->
            <div class="perfil">
                <a> <?php 
                        $nomUsuari = $_SESSION["loginUsuari"]; 
                        echo $nomUsuari;
                    ?> 
                </a>
                <div class="dropdown-content">
                    <a href="../vista/vistaCanviContra.php">Nova contrasenya</a>
                    <a href="../controlador/controladorTancarSessio.php">Tancar sessió</a>
                </div>
            </div>
        </nav>

        <div class="button-container">
        <!-- Botons Inserir/modificar/esborrar i consultar -->
            <a href="vistaInserir.php" class="btn return-btn">Inserir</a>
            <a href="vistaEsborrar.php" class="btn return-btn">Esborrar</a> 
            <a href="vistaModificar.php" class="btn return-btn">Modificar</a>
            <a href="vistaConsultar.php" class="btn return-btn">Consultar</a> 
        </div>

    </body>
</html>
