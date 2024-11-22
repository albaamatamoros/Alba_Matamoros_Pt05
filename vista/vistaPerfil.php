<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Alba Matamoros Morales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilIniciarRegistrar.css">
    <link rel="stylesheet" href="../estils/estilBarra.css">
    <link rel="stylesheet" href="../estils/estilError.css">
    <title>Perfil</title>
</head>
<body>
    <?php //Verificar si la sessió no està activa. (Comprovació perquè no s'intenti accedir mitjançant ruta).
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION["loginId"])) { header("Location: ../index.php" );}
        require_once "../controlador/controladorAdministrarPerfil.php";
    ?>
    
    <nav>
        <!-- INICI y GESTIÓ D'ARTICLES -->
        <div class="left">
            <a href="../index.php">INICI</a>
        </div>

        <!-- PERFIL -->
        <div class="perfil">
            <!-- Botons de perfil -->
            <div class="perfil">
                <a> <?php 
                        $nomUsuari = $_SESSION["loginUsuari"]; 
                        echo $nomUsuari;
                    ?> 
                </a>
                <div class="dropdown-content">
                    <a href="../vista/vistaCanviContra.php">Canviar contrasenya</a>
                    <a href="../controlador/controladorTancarSessio.php">Tancar sessió</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <h2>Administrar perfil</h2>
        <form action="save_profile.php" method="POST">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_SESSION["loginUsuari"]) ? $_SESSION["loginUsuari"] : ''; ?>">
            
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION["loginCorreu"]) ? $_SESSION["loginCorreu"] : ''; ?>" readonly disabled>
            
            <div class="container-button">
                <a href="../vista/vistaCanviContra.php" class="buttons">Canviar Contrasenya</a>
            </div>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>