<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar reservas
$reservas = [
    ['id_cliente' => 1, 'fecha_reserva' => '2024-07-14', 'id_vuelo' => 1, 'id_hotel' => 1],
    // Agrega más reservas aquí
];

foreach ($reservas as $reserva) {
    $sql = "INSERT INTO reserva (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES ('{$reserva['id_cliente']}', '{$reserva['fecha_reserva']}', '{$reserva['id_vuelo']}', '{$reserva['id_hotel']}')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consulta avanzada
$sql = "SELECT hotel.nombre, COUNT(reserva.id_reserva) AS numero_reservas 
        FROM reserva 
        INNER JOIN hotel ON reserva.id_hotel = hotel.id_hotel 
        GROUP BY hotel.id_hotel 
        HAVING COUNT(reserva.id_reserva) > 2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Hoteles con más de dos reservas</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "Hotel: " . $row['nombre'] . " - Número de reservas: " . $row['numero_reservas'] . "<br>";
    }
} else {
    echo "No hay hoteles con más de dos reservas";
}

$conn->close();
?>
