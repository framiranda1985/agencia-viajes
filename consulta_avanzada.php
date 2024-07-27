<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AGENCIA";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta avanzada para mostrar hoteles con más de dos reservas
$sql = "
SELECT h.nombre, COUNT(r.id_reserva) AS total_reservas
FROM HOTEL h
JOIN RESERVA r ON h.id_hotel = r.id_hotel
GROUP BY h.id_hotel
HAVING total_reservas > 2
ORDER BY total_reservas DESC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Hotel</th><th>Total Reservas</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['nombre'] . "</td><td>" . $row['total_reservas'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron hoteles con más de dos reservas.";
}

$conn->close();
?>
