<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a base de datos (InfinityFree)
$conn = new mysqli("sql112.infinityfree.com", "if0_38870734", "l6fyi3OP0tFHs", "if0_38870734_proyecto");

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Verificar si ya existe el usuario 'admin'
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = 'admin'");
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "⚠️ El usuario administrador ya existe.";
} else {
    $hash = password_hash("admin123", PASSWORD_DEFAULT); // Contraseña segura
    $insert = $conn->prepare("INSERT INTO usuarios (usuario, contrasena, rol) VALUES ('admin', ?, 'admin')");
    $insert->bind_param("s", $hash);
    if ($insert->execute()) {
        echo "✅ Usuario administrador creado con contraseña: <strong>admin123</strong>";
    } else {
        echo "❌ Error al crear el administrador.";
    }
    $insert->close();
}

$stmt->close();
$conn->close();
?>
