<nav>
    <!-- INICI y GESTIÓ D'ARTICLES -->
    <div class="left">
    <a href="index.php">INICI</a>
        <!-- Botó activat amb l'inici de sessió fet "GESTIÓ DE PERSONATGES" -->
        <?php if(isset($_SESSION["loginId"])) {
            echo ' <a href="vista/vistaMenu.php">GESTIÓ DE PERSONATGES</a> ';
        } ?>
    </div>

    <!-- PERFIL -->
    <div class="perfil">
        <!-- Botons de perfil -->
        <?php if (!isset($_SESSION['loginId'])): ?>
            <a>
                <img src="vista/imatges/imatgesUsers/defaultUser.jpg" class="user-avatar">
                PERFIL
            </a>
            <div class="dropdown-content">
                <a href="vista/vistaLogin.php">Iniciar sessió</a>
                <a href="vista/vistaRegistrarse.php">Registrar-se</a>
        <?php else: ?>
            <a> 
                <img src="<?php echo isset($_SESSION['loginImage']) ? $_SESSION['loginImage'] : "vista/imatges/imatgesUsers/defaultUser.jpg" ; ?>" class="user-avatar"><?php 
                    $nomUsuari = $_SESSION["loginUsuari"]; 
                    echo $nomUsuari;
                ?> 
            </a>
            <div class="dropdown-content">
                <a href="vista/vistaPerfil.php">Administrar perfil</a>
                <a href="vista/vistaCanviContra.php">Canviar contrasenya</a>
                <a href="./controlador/controladorTancarSessio.php">Tancar sessió</a>
            <?php endif; ?>
        </div>
    </div>
</nav>