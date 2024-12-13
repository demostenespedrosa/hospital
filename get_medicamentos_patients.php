<?php
include 'db.php';

// Buscar pacientes na etapa Sala de Medicamentos
$sql = "SELECT p.id, p.nome_completo, c.medicamentos_prescritos 
        FROM pacientes p
        INNER JOIN consultas c ON p.id = c.paciente_id
        WHERE p.etapa = 'Sala de Medicamentos'";
$result = $conn->query($sql);

$output = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nome_completo']}</td>
            <td>{$row['medicamentos_prescritos']}</td>
            <td>
                <button class='btn btn-primary btn-sm register-medicamento' data-id='{$row['id']}'>Registrar</button>
            </td>
        </tr>";
    }
} else {
    $output .= "<tr><td colspan='4' class='text-center'>Nenhum paciente na fila.</td></tr>";
}

echo $output;
?>
