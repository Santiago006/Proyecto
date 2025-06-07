<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$directorio = "archivos/";
$mensaje = "";

// Crear directorio si no existe
if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}

// Procesar eliminación de archivo
if (isset($_GET['eliminar'])) {
    $archivoEliminar = basename($_GET['eliminar']);
    if (strpos($archivoEliminar, $usuario . "_") === 0 && file_exists($directorio . $archivoEliminar)) {
        unlink($directorio . $archivoEliminar);
        $mensaje = "✅ Archivo eliminado.";
    } else {
        $mensaje = "❌ No se puede eliminar ese archivo.";
    }
}

// Procesar subida de archivo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["archivo"])) {
    if ($_FILES["archivo"]["error"] === 0) {
        $nombreOriginal = basename($_FILES["archivo"]["name"]);
        $nombreFinal = $usuario . "_" . time() . "_" . $nombreOriginal;
        $rutaDestino = $directorio . $nombreFinal;

        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaDestino)) {
            $mensaje = "✅ Archivo subido correctamente.";
        } else {
            $mensaje = "❌ Error al mover el archivo.";
        }
    } else {
        $mensaje = "❌ Error al subir el archivo: código " . $_FILES["archivo"]["error"];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Usuario</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; margin: 0; padding: 20px; }
    header { background: #1565c0; color: white; padding: 20px; text-align: center; }
    .container {
      background: white; max-width: 700px; margin: 30px auto;
      padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="file"], input[type="submit"] {
      display: block; width: 100%; margin: 15px 0; padding: 10px;
    }
    .mensaje { color: green; text-align: center; }
    .error { color: red; text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
    .salir { text-align: center; margin-top: 20px; }
  </style>
</head>
<body>
<header>
  <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h2>
</header>
<div class="container">
  <h3>Subir archivo</h3>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="archivo" required>
    <input type="submit" value="Subir archivo">
  </form>
  <?php if ($mensaje) echo "<p class='" . (strpos($mensaje, '✅') !== false ? 'mensaje' : 'error') . "'>$mensaje</p>"; ?>

  <h3>Archivos subidos</h3>
  <table>
    <tr><th>Nombre</th><th>Acciones</th></tr>
    <?php
    $archivos = glob($directorio . $usuario . "_*");
    if ($archivos) {
        foreach ($archivos as $archivo) {
            $nombre = basename($archivo);
            echo "<tr>
                <td>$nombre</td>
                <td>
                  <a href='$archivo' download>Descargar</a> |
                  <a href='?eliminar=$nombre' onclick=\"return confirm('¿Seguro que quieres eliminar este archivo?')\">Eliminar</a>
                </td>
              </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No has subido archivos aún.</td></tr>";
    }
    ?>
  </table>

  <div class="salir">
    <a href="logout.php">Cerrar sesión</a>
  </div>
</div>
</body>
</html>
