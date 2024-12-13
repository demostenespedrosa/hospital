<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $sintomas = $_POST['sintomas'];
    $sinais_vitais = $_POST['sinais_vitais'];

    // Inserir os dados da anamnese
    $sql_anamnese = "INSERT INTO anamneses (paciente_id, sintomas, sinais_vitais)
                     VALUES ('$paciente_id', '$sintomas', '$sinais_vitais')";
    if ($conn->query($sql_anamnese) === TRUE) {
        // Atualizar etapa do paciente para Consulta Médica
        $sql_update = "UPDATE pacientes SET etapa = 'Consulta Médica' WHERE id = $paciente_id";
        $conn->query($sql_update);

        echo "Anamnese registrada e paciente avançado para Consulta Médica.";
    } else {
        echo "Erro ao registrar anamnese: " . $conn->error;
    }
}
?>
