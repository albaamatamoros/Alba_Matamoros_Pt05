<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {  
        setcookie("personatgesCookie", $_POST['select'], 0);
        header("Location: .");
    } else if (!isset($_COOKIE['personatgesCookie'])) {
        setcookie("personatgesCookie", 5 , 0);
    }
    require_once './controlador/controladorPaginacio.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Alba Matamoros Morales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estils/estilBarra.css">
    <link rel="stylesheet" href="estils/estilMostrar.css">
    
    <title>Inici</title>
    <script>
        function confirmarEsborrar(idPersonatge) {
            let confirmacion = confirm("Segur que vols esborrar aquest personatge?");
            
            if (confirmacion) {
                window.location.href = './controlador/controladorEsborrarIndex.php?id_personatge=' + idPersonatge;
            }
        }
    </script>
</head>
<body>
    <nav>
        <!-- INICI y GESTIÓ D'ARTICLES -->
        <div class="left">
        <a href="index.php">INICI</a>
            <?php if(isset($_SESSION["loginId"])) {
                echo ' <a href="vista/vistaMenu.php">GESTIÓ DE PERSONATGES</a> ';
            } ?>
        </div>

        <!-- PERFIL -->
        <div class="perfil">
            <?php if (!isset($_SESSION['loginId'])): ?>
                <a>PERFIL</a>
                <div class="dropdown-content">
                    <a href="vista/vistaLogin.php">Iniciar sessió</a>
                    <a href="vista/vistaRegistrarse.php">Registrar-se</a>
            <?php else: ?>
                <a> <?php 
                        $nomUsuari = $_SESSION["loginUsuari"]; 
                        echo $nomUsuari;
                    ?> 
                </a>
                <div class="dropdown-content">
                    <a href="vista/vistaCanviContra.php">Nova contrasenya</a>
                    <a href="./controlador/controladorTancarSessio.php">Tancar sessió</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- MOSTRAR PERSONATGES -->
    <section>
        <?php if (!isset($_SESSION['loginId'])): ?>

            <!-- PERSONATGES GLOBALS -->
            <!-- Tornem la consulta amb tots els peronatges globals -->

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

            <div class="titulo"> <h1 class="titulo-personatges">Llista de Personatges Global</h1> </div>
            <div class="personatges-container">
                <?php echo paginacioGlobal(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
            </div>

            <!-- PAGINACIÓ GLOBAL -->
            <!-- Cridem a la funció que fa els càlculs i configura la paginació. -->
            <section class="paginacio">
            <div class="pagination">
                <?php echo retornarLinksGlobal(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
            </div>
            </section>

        <?php else: ?>
            
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

            <!-- PERSONATGES USUARI -->
            <div class="titulo"> <h1 class="titulo-personatges">Llista de Personatges</h1> </div>
                <div class="personatges-container">
                    <?php echo paginacioPerUsuari(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
                </div>

            <!-- PAGINACIÓ PER USUARI -->
            <!-- Cridem a la funció que fa els càlculs i configura la paginació. -->
            <section class="paginacio">
            <div class="pagination">
                <!-- Tornem la consulta amb tots els peronatges globals -->
                <?php echo retornarLinksPerUsuari(isset($_GET["pagina"]) ? $_GET["pagina"] : PAGINA); ?>
            </div>
            </section>
        <?php endif; ?>
    </section>
</body>
</html>
