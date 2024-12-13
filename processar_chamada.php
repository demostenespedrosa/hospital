<?php
include 'db.php';

$setor = $_GET['setor'];

// Buscar o próximo paciente na fila do setor atual
$sql = "SELECT * FROM pacientes WHERE etapa = '$setor' ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();
    echo json_encode(['paciente' => $paciente]);
} else {
    echo json_encode(['paciente' => null]);
}
?>
