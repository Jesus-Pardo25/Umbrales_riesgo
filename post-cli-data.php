<?php
$servername = "172.17.0.2"; // Cambiar si es diferente
$dbname = "saih"; // Nombre de tu base de datos
$username = "usuario_remoto"; // Nombre de usuario de la base de datos
$password = "micontrase"; // Contraseña del usuario de la base de datos
$port = 3306;

// Habilitar el registro de errores
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php-error.log');

// Función para limpiar y validar los datos recibidos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si la solicitud es un POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del POST y limpiarlos
    $est = isset($_POST["est"]) ? test_input($_POST["est"]) : '';
    $fecha = isset($_POST["fecha"]) ? test_input($_POST["fecha"]) : '';
    $tmp = isset($_POST["tmp"]) ? test_input($_POST["tmp"]) : '';
    $hum = isset($_POST["hum"]) ? test_input($_POST["hum"]) : '';
    $pcp = isset($_POST["pcp"]) ? test_input($_POST["pcp"]) : '';
    $win = isset($_POST["win"]) ? test_input($_POST["win"]) : '';
    $wind = isset($_POST["wind"]) ? test_input($_POST["wind"]) : '';
    $ins = isset($_POST["ins"]) ? test_input($_POST["ins"]) : '';
    $pat = isset($_POST["pat"]) ? test_input($_POST["pat"]) : '';
    $ph = isset($_POST["ph"]) ? test_input($_POST["ph"]) : '';
    $sdt = isset($_POST["sdt"]) ? test_input($_POST["sdt"]) : '';
    $tbd = isset($_POST["tbd"]) ? test_input($_POST["tbd"]) : '';
    
    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Preparar la consulta SQL para insertar datos
    $sql = "INSERT INTO data (est, fecha, tmp, hum, pcp, win, wind, ins, pat, ph, sdt, tbd) 
            VALUES ('$est', '$fecha', '$tmp', '$hum', '$pcp', '$win', '$wind', '$ins', '$pat', '$ph', '$sdt', '$tbd')";
    
    // Ejecutar la consulta y verificar si se insertaron los datos correctamente
    if ($conn->query($sql) === TRUE) {
        echo "Registro creado exitosamente";
    } else {
        error_log("Error: " . $sql . " - " . $conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    error_log("No se recibió una solicitud POST");
    echo "No se recibió una solicitud POST";
}
?>

