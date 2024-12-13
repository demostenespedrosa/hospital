<?php
include 'db.php';

// Buscar pacientes na etapa Consulta Médica
$sql = "SELECT * FROM pacientes WHERE etapa = 'Consulta Médica'";
$result = $conn->query($sql);

$output = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nome_completo']}</td>
            <td>-</td>
            <td>-</td>
            <td>
                <button class='btn btn-primary btn-sm register-consulta' data-id='{$row['id']}'>Registrar</button>
            </td>
        </tr>";
    }
} else {
    $output .= "<tr><td colspan='5' class='text-center'>Nenhum paciente na fila.</td></tr>";
}

echo $output;
?>
