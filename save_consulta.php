<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $diagnostico = $_POST['diagnostico'];
    $medicamentos = $_POST['medicamentos'];

    // Inserir os dados da consulta
    $sql_consulta = "INSERT INTO consultas (paciente_id, diagnostico, medicamentos_prescritos)
                     VALUES ('$paciente_id', '$diagnostico', '$medicamentos')";
    if ($conn->query($sql_consulta) === TRUE) {
        // Atualizar etapa do paciente para Sala de Medicamentos
        $sql_update = "UPDATE pacientes SET etapa = 'Sala de Medicamentos' WHERE id = $paciente_id";
        $conn->query($sql_update);

        echo "Consulta registrada e paciente avançado para Sala de Medicamentos.";
    } else {
        echo "Erro ao registrar consulta: " . $conn->error;
    }
}
?>
