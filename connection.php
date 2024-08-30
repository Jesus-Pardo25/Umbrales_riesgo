<?php
$servername = "172.17.0.2";  // IP del contenedor Docker de MySQL
$username = "usuario_remoto";
$password = "micontrase";
$database = "saih";  // El nombre de tu base de datos

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully to the MySQL database\n";

// Cerrar conexión
mysqli_close($conn);
?>
