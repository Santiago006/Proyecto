<?php
session_start();
$mensaje = "";
$conn = new mysqli("sql112.infinityfree.com", "if0_38870734", "l6fyi3OP0tFHs", "if0_38870734_proyecto");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Contraseña segura

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $clave);
    
    if ($stmt->execute()) {
        $mensaje = "✅ Usuario registrado. Ahora puedes iniciar sesión.";
    } else {
        $mensaje = "❌ El usuario ya existe o hubo un error.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <style>
    body { font-family: 'Segoe UI'; background: #f4f7fa; margin: 0; }
    header { background: #1a237e; color: white; padding: 20px; text-align: center; }
    .formulario { max-width: 400px; margin: 60px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 8px; }
    input[type="submit"] { background: #1565c0; color: white; font-weight: bold; border: none; cursor: pointer; }
    input[type="submit"]:hover { background: #0d47a1; }
    .mensaje { color: green; text-align: center; }
  </style>
</head>
<body>
<header><h2>Gestoría Online</h2></header>
<div class="formulario">
  <h2>Registro</h2>
  <form method="post">
    <input type="text" name="usuario" placeholder="Usuario deseado" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="submit" value="Registrarse">
  </form>
  <?php if ($mensaje) echo "<p class='mensaje'>$mensaje</p>"; ?>

   <p style="text-align: center; margin-top: 10px;">
    ¿Tienes cuenta? <a href="login.php">iniciar sesion</a>
  </p>
  <p style="text-align: center; margin-top: 10px;">
    <a href="index.php">Volver pagina principal</a>
  </p>
</div>
</body>
</html>
