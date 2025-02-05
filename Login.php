<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Ingresar</button>
    </form>
    <p><?php echo isset($mensaje) ? $mensaje : ''; ?></p>
</body>
</html>
<?php
// Definir la ruta base para evitar concatenaciones incorrectas
define('BASE_PATH', __DIR__);

require_once BASE_PATH . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'ClassIniciarSesionController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $controller = new ClassIniciarSesionController();
    $usuario = $controller->iniciarSesion($email, $password);
    echo "Nombre de Usuario: ".$usuario['nombre'];
    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        $mensaje = "Credenciales incorrectas.";
    }
}
?>