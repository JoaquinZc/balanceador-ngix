<?php
$servername = "192.168.100.61";
$username = "joaquin";
$password = "hola123xD";
$dbname = "dis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario para agregar una nueva nota
    if (isset($_POST["nueva_nota"]) && !empty($_POST["nueva_nota"])) {
        $usuario = "joaquin";  // Reemplaza con el usuario actual
        $nuevaNota = $conn->real_escape_string($_POST["nueva_nota"]);
        $sql = "INSERT INTO notas (usuario, nota) VALUES ('$usuario', '$nuevaNota')";

        if ($conn->query($sql) === TRUE) {
            echo "Nota agregada correctamente.";
        } else {
            echo "Error al agregar nota: " . $conn->error;
        }
    }
}

// Obtener y mostrar las notas del usuario
$usuario = "joaquin";  // Reemplaza con el usuario actual
$sql = "SELECT * FROM notas WHERE usuario = '$usuario' ORDER BY fecha_creacion DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas del Usuario - web 2</title>
</head>
<body>
    <h1>Notas del Usuario - web 2</h1>

    <!-- Formulario para agregar una nueva nota -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nueva_nota">Nueva Nota:</label>
        <input type="text" name="nueva_nota" required>
        <button type="submit">Agregar Nota</button>
    </form>

    <hr>

    <!-- Mostrar las notas existentes -->
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>ID: " . $row["id"]. " - Nota: " . $row["nota"]. " - Fecha: " . $row["fecha_creacion"]. "</p>";
        }
    } else {
        echo "<p>No hay notas para este usuario.</p>";
    }
    ?>

    <!-- Cerrar la conexión -->
    <?php $conn->close(); ?>
</body>
</html>
