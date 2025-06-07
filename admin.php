<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$directorio = "archivos/";
$mensaje = "";
$usuarioSeleccionado = "";

// Eliminar archivo
if (isset($_GET['eliminar'])) {
    $archivoEliminar = basename($_GET['eliminar']);
    if (file_exists($directorio . $archivoEliminar)) {
        unlink($directorio . $archivoEliminar);
        $mensaje = "✅ Archivo eliminado.";
    } else {
        $mensaje = "❌ No se encontró el archivo.";
    }
}

// Subir archivo a un usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["usuario_objetivo"]) && isset($_FILES["archivo"])) {
    $usuarioSeleccionado = trim($_POST["usuario_objetivo"]);
    if ($usuarioSeleccionado === "") {
        $mensaje = "❌ Debes indicar un usuario.";
    } elseif ($_FILES["archivo"]["error"] === 0) {
        $nombreOriginal = basename($_FILES["archivo"]["name"]);
        $nombreFinal = $usuarioSeleccionado . "_" . time() . "_" . $nombreOriginal;
        $rutaDestino = $directorio . $nombreFinal;
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaDestino)) {
            $mensaje = "✅ Archivo subido para $usuarioSeleccionado.";
        } else {
            $mensaje = "❌ Error al mover el archivo.";
        }
    } else {
        $mensaje = "❌ Error al subir el archivo: código " . $_FILES["archivo"]["error"];
    }
}

// Buscar archivos por usuario exacto
$usuarioFiltro = "";
if (isset($_GET["usuario"])) {
    $usuarioFiltro = trim($_GET["usuario"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Archivos</title>
  <style>
    body { font-family: Arial; background: #f2f2f2; margin: 0; padding: 20px; }
    header { background: #b71c1c; color: white; padding: 20px; text-align: center; }
    .container {
      background: white; max-width: 850px; margin: 30px auto;
      padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    .mensaje { color: green; text-align: center; }
    .error { color: red; text-align: center; }
    .salir { text-align: center; margin-top: 20px; }
    form { margin: 20px 0; text-align: center; }
    input[type="text"], input[type="file"] {
      padding: 8px; margin: 5px; width: 250px;
    }
    input[type="submit"] {
      padding: 8px 16px; background: #b71c1c; color: white; border: none; cursor: pointer;
    }
  </style>
</head>
<body>
<header>
  <h2>Panel de Administración - Archivos de Usuarios</h2>
</header>
<div class="container">
  <?php if ($mensaje) echo "<p class='" . (strpos($mensaje, '✅') !== false ? 'mensaje' : 'error') . "'>$mensaje</p>"; ?>

  <form method="post" enctype="multipart/form-data">
    <h3>📤 Subir archivo a un usuario</h3>
    <input type="text" name="usuario_objetivo" placeholder="Nombre del usuario" value="<?php echo htmlspecialchars($usuarioSeleccionado); ?>" required>
    <input type="file" name="archivo" required>
    <input type="submit" value="Subir archivo">
  </form>

  <form method="get">
    <h3>🔎 Buscar archivos por usuario</h3>
    <input type="text" name="usuario" placeholder="Usuario exacto" value="<?php echo htmlspecialchars($usuarioFiltro); ?>">
    <input type="submit" value="Buscar">
  </form>

  <table>
    <tr><th>Archivo</th><th>Usuario</th><th>Acciones</th></tr>
    <?php
    $archivos = glob($directorio . "*");
    $encontrados = 0;
    if ($archivos) {
        foreach ($archivos as $archivo) {
            $nombre = basename($archivo);
            $usuarioArchivo = explode("_", $nombre)[0];
            if ($usuarioFiltro && $usuarioArchivo !== $usuarioFiltro) continue;
            $encontrados++;
            echo "<tr>
                    <td>$nombre</td>
                    <td>$usuarioArchivo</td>
                    <td>
                      <a href='$archivo' download>Descargar</a> |
                      <a href='?eliminar=$nombre' onclick=\"return confirm('¿Eliminar este archivo?')\">Eliminar</a>
                    </td>
                  </tr>";
        }
    }
    if ($encontrados === 0) {
        echo "<tr><td colspan='3'>No se encontraron archivos.</td></tr>";
    }
    ?>
  </table>

  <div class="salir">
    <a href="logout.php">Cerrar sesión</a>
  </div>
</div>
</body>
</html>
