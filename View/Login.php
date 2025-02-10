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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Tarjeta de inicio de sesión centrada */
        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px; 
        }

        /* Estilo para el icono dentro del campo */
        .password-container {
            position: relative;
        }

        .password-container i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column justify-content-center align-items-center vh-60">
        <div class="login-container">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php">
                <input type="hidden" name="entity" value="Login">
                <input type="hidden" name="action" value="procesarLogin">
                
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <div class="password-container">
                        <input type="password" name="contrasena" id="password" class="form-control" required>
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Volver</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let passwordField = document.getElementById("password");
            let icon = this;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
