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
<body class="main-content">
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
                <a> 
                    <img src="<?php echo isset($_SESSION['loginImage']) ? $_SESSION['loginImage'] : "../vista/imatges/imatgesUsers/defaultUser.jpg" ; ?>" class="user-avatar"><?php 
                        $nomUsuari = $_SESSION["loginUsuari"]; 
                        echo $nomUsuari;
                    ?> 
                </a>
                <div class="dropdown-content">
                    <a href="../vista/vistaPerfil.php">Administrar perfil</a>
                    <a href="../vista/vistaCanviContra.php">Canviar contrasenya</a>
                    <a href="../controlador/controladorTancarSessio.php">Tancar sessió</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <h2>Administrar perfil</h2>
        <form action="../controlador/controladorAdministrarPerfil.php" method="POST" enctype="multipart/form-data">
            <div class="login-container-user">
                <img src="<?php echo isset($_SESSION['loginImage']) ? $_SESSION['loginImage'] : "../vista/imatges/imatgesUsers/defaultUser.jpg" ; ?>" class="user-avatar2">
            </div>

            <label for="arxiu">Selecciona un arxiu:</label>
            <input type="file" name="arxiu" id="arxiu">

            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_SESSION["loginUsuari"]) ? $_SESSION["loginUsuari"] : ''; ?>">
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo isset($_SESSION["loginNom"]) ? $_SESSION["loginNom"] : ''; ?>" readonly disabled>

            <label for="cognom">Cognoms</label>
            <input type="text" id="cognom" name="cognom" value="<?php echo isset($_SESSION["loginCognom"]) ? $_SESSION["loginCognom"] : ''; ?>" readonly disabled>

            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION["loginCorreu"]) ? $_SESSION["loginCorreu"] : ''; ?>" readonly disabled>
            
            <!-- MISSATGE D'ERROR Y DE CONFIRMACIÓ -->
            <?php if (!empty($errors)): ?>
                    <div class="alert error-container">
                        <span class="alert-icon error-icon">⚠️</span> <!-- Icono de advertencia -->
                        <div>
                            <?php foreach ($errors as $error): ?>
                                <p class="alert-text error-message"><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php elseif (!empty($correcte)): ?>
                    <div class="success-container">
                        <span class="alert-icon success-icon">✔️</span> <!-- Icono de éxito -->
                        <div>
                            <p class="alert-text success-message"><?php echo $correcte; ?></p>
                        </div>
                    </div>
            <?php endif; ?>

            <input name="action" type="submit" value="Guardar canvis">
        </form>
    </div>
</body>
</html>