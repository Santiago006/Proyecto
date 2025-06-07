<?php
// Mostrar errores para depuración en InfinityFree
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$mensaje = "";
$conn = new mysqli("sql112.infinityfree.com", "if0_38870734", "l6fyi3OP0tFHs", "if0_38870734_proyecto");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT contrasena, rol FROM usuarios WHERE usuario = ?");
    if ($stmt) {
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hash, $rol);
            $stmt->fetch();

            if (password_verify($clave, $hash)) {
                $_SESSION['usuario'] = $usuario;
                header("Location: " . ($rol === 'admin' ? 'admin.php' : 'dashboard_usuario.php'));
                exit;
            } else {
                $mensaje = "❌ Contraseña incorrecta.";
            }
        } else {
            $mensaje = "❌ Usuario no encontrado.";
        }

        $stmt->close();
    } else {
        $mensaje = "❌ Error en la consulta preparada.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <style>
    body { font-family: 'Segoe UI'; background: #f4f7fa; margin: 0; }
    header { background: #1a237e; color: white; padding: 20px; text-align: center; }
    .formulario {
      max-width: 400px; margin: 60px auto; padding: 30px;
      background: white; border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    input {
      width: 100%; padding: 12px; margin-bottom: 15px;
      border: 1px solid #ccc; border-radius: 8px;
    }
    input[type="submit"] {
      background: #1565c0; color: white; font-weight: bold;
      border: none; cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #0d47a1;
    }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>
<header><h2>Gestoría Online - Iniciar sesión</h2></header>
<div class="formulario">
  <form method="post">
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="submit" value="Entrar">
  </form>
  <?php if ($mensaje) echo "<p class='error'>$mensaje</p>"; ?>

  <p style="text-align: center; margin-top: 10px;">
    ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
  </p>
  <p style="text-align: center; margin-top: 10px;">
    <a href="index.php">Volver a la página principal</a>
  </p>
</div>
</body>
</html>
