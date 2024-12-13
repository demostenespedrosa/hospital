<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $medicamento = $_POST['medicamento'];
    $enfermeiro_responsavel = $_POST['enfermeiro_responsavel'];

    // Inserir os dados da aplicação do medicamento
    $sql_medicamento = "INSERT INTO medicamentos_aplicados (paciente_id, medicamento, enfermeiro_responsavel)
                        VALUES ('$paciente_id', '$medicamento', '$enfermeiro_responsavel')";
    if ($conn->query($sql_medicamento) === TRUE) {
        // Atualizar etapa do paciente para Alta
        $sql_update = "UPDATE pacientes SET etapa = 'Alta' WHERE id = $paciente_id";
        $conn->query($sql_update);

        echo "Medicamento registrado e paciente finalizado com alta.";
    } else {
        echo "Erro ao registrar medicamento: " . $conn->error;
    }
}
?>
