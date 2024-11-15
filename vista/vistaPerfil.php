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
    ?>
    <div class="login-container">
        <h2>Editar Perfil</h2>
        <form action="save_profile.php" method="POST">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
            
            <input type="submit" value="Guardar Cambios">
        </form>
        <div class="form-footer">
            <a href="profile.php">Tornar a inici</a> <!-- Enlace opcional para volver -->
        </div>
    </div>
</body>
</html>