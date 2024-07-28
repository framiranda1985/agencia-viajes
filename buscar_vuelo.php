<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$origen = $_POST['origen'];
$destino = $_POST['destino'];
$fecha = $_POST['fecha'];

$sql = "SELECT * FROM vuelo WHERE origen = '$origen' AND destino = '$destino'";
if (!empty($fecha)) {
    $sql .= " AND fecha = '$fecha'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Vuelos Disponibles</h2>";
    echo "<table border='1'>
            <tr>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Plazas Disponibles</th>
                <th>Precio</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["origen"] . "</td>
                <td>" . $row["destino"] . "</td>
                <td>" . $row["fecha"] . "</td>
                <td>" . $row["plazas_disponibles"] . "</td> <!-- Aquí he cambiado 'plazas' por 'plazas_disponibles' -->
                <td>" . $row["precio"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron vuelos.";
}

$conn->close();
?>
