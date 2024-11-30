<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Alba Matamoros Morales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilPerfil.css">
    <link rel="stylesheet" href="../estils/estilBarra.css">
    <link rel="stylesheet" href="../estils/estilError.css">
    <title>Registrar-se</title>
</head>
    <?php
        //Verificar si la sessió no està activa. (Comprovació perquè no s'intenti accedir mitjançant ruta).
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once "../controlador/controladorErrors.php";

        $errors = isset($errors) ? $errors : [];
        $correcte = isset($correcte) ? $correcte : null;
    ?>
    <body class="main-content">
        <!-- HEADER -->
        <nav>
            <!-- INICI y GESTIÓ D'ARTICLES -->
            <div class="left">
                <a href='../index.php'>INICI</a>
                <a href="../vista/vistaMenu.php">GESTIÓ DE PERSONATGES</a>
            </div>

            <!-- PERFIL -->
            <div class="perfil">
                <a> 
                    <img src="<?php echo isset($_SESSION['loginImage']) ? $_SESSION['loginImage'] : "../vista/imatges/imatgesUsers/defaultUser.jpg" ; ?>" class="user-avatar"><?php 
                        $nomUsuari = $_SESSION["loginUsuari"]; 
                        echo $nomUsuari;
                    ?> 
                </a>
                <div class="dropdown-content">
                    <a href="../vista/vistaPerfil.php">Administrar perfil</a>
                    <a href="../vista/vistaCanviContra.php">Canviar contrasenya</a>
                    <?php if ($_SESSION["loginAdministrador"] == 1): ?>
                        <a href="../vista/vistaAdministrarUsuaris.php">Administrar usuaris</a>
                    <?php endif; ?>
                    <a href="../controlador/controladorTancarSessio.php">Tancar sessió</a>
                </div>
            </div>
        </nav>
        
        <!-- BODY -->
        <div class="login-container">
            <h2>Canviar Contrasenya</h2>
            <form action="../controlador/controladorAdministrarPerfil.php" method="POST">

                <label for="contrasenya_actual">Contrasenya Actual:</label>
                <input type="password" id="contrasenya_actual" name="contrasenya_actual">

                <label for="nova_contrasenya">Nova Contrasenya:</label>
                <input type="password" id="nova_contrasenya" name="nova_contrasenya">

                <label for="confirmar_contrasenya">Confirmar Contrasenya:</label>
                <input type="password" id="confirmar_contrasenya" name="confirmar_contrasenya">

                <input type="submit" name="action" value="Canviar Contrasenya">

                <!-- CONTROL D'ERRORS -->
                <?php mostrarMissatge($errors, $correcte) ?>
            </form>
        </div>
    </body>
</html>