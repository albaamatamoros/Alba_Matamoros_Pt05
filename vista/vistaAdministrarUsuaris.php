<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilPerfil.css">
    <link rel="stylesheet" href="../estils/estilBarra.css">
    <link rel="stylesheet" href="../estils/estilError.css">
    <script>
    function confirmarEsborrarUsuari(idUsuari) {
        let confirmacion = confirm("Segur que vols esborrar aquest usuari?");
        
        if (confirmacion) {
            // Redirige a la URL del controlador, pasando el ID del usuario como parámetro GET
            window.location.href = '../controlador/controladorEsborrar.php?id_usuari=' + idUsuari;
        }
    }
</script>
    <title>Administrar usuaris</title>
</head>
<body>
    <?php //Verificar si la sessió no està activa. (Comprovació perquè no s'intenti accedir mitjançant ruta).
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION["loginId"])) { header("Location: ../index.php" );}
        require_once "../controlador/controladorPaginacio.php";
    ?>
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
                <a href="../controlador/controladorTancarSessio.php">Tancar sessió</a>
            </div>
        </div>
    </nav>
    <div class="usuarios-container">
        <h2 class="usuarios-titulo">Llistat d'Usuaris</h2>
        <div class="usuarios-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Imatge</th>
                        <th>Usuari</th>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th>Correu</th>
                        <th>Acció</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo mostrarUsuaris(); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>