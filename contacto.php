<?php
$servername = "localhost"; // Cambia si es necesario
$username = "root"; // Cambia por tu usuario
$password = ""; // Cambia por tu contraseña
$dbname = "contacto"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['name'];
$correo = $_POST['email'];
$mensaje = $_POST['message'];

// Preparar y ejecutar la consulta
$sql = "INSERT INTO mensajes (nombre, correo, mensaje) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $mensaje);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Resultado del Contacto</title>
</head>
<body>
    <div class="container mt-5">
        <?php
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Mensaje enviado con éxito.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
        }
        ?>
        <a href="index.html" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

