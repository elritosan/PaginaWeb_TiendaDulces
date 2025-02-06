<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$error = isset($_GET['error']) ? "Credenciales incorrectas" : "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4">
        <h2 class="text-center">Iniciar Sesión</h2>
        <?php if ($error): ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php">
            <!-- Enviar la entidad y acción en un input hidden -->
            <input type="hidden" name="entity" value="Login">
            <input type="hidden" name="action" value="procesarLogin">
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>