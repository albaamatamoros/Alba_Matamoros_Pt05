<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {  
        setcookie("personatgesCookie", $_POST['select'], 0);
        header("Location: ../vista/vistaConsultar.php");
    } else if (!isset($_COOKIE['personatgesCookie'])) {
        setcookie("personatgesCookie", 5 , 0);
    }
    require_once '../controlador/controladorPaginacioConsultarMenu.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Alba Matamoros Morales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilBarra.css">
    <link rel="stylesheet" href="../estils/estilMostrar.css">
    <title>Consultar personatges</title>
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

    <!-- MOSTRAR PERSONATGES -->
    <section>

        <div class="selectPersonatge">
            <form action="" method="POST">
                <select name="select" onchange="this.form.submit()">
                <?php foreach([5, 10, 15, 20] as $num): ?>
                    <option value="<?php echo $num; ?>" <?php if (isset($_COOKIE['personatgesCookie']) && $_COOKIE['personatgesCookie'] == $num) echo 'selected'; ?>>
                        <?php echo $num; ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- PERSONATGES GLOBALS -->
        <!-- Tornem la consulta amb tots els peronatges globals -->
        <div class="titulo"> <h1 class="titulo-personatges">Llista de Personatges Global</h1> </div>
            <div class="personatges-container">
                <?php echo paginacioGlobalConsultar(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
            </div>

            <!-- PAGINACIÓ GLOBAL -->
            <!-- Cridem a la funció que fa els càlculs i configura la paginació. -->
            <section class="paginacio">
            <div class="pagination">
                <?php echo retornarLinksConsultar(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
            </div>
            </section>
    </section>
</body>
</html>