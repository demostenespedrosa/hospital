<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $setor_atual = $_POST['setor'];

    // Definir a próxima etapa
    $proxima_etapa = match ($setor_atual) {
        'Cadastro' => 'Anamnese',
        'Anamnese' => 'Consulta Médica',
        'Consulta Médica' => 'Sala de Medicamentos',
        'Sala de Medicamentos' => 'Alta',
        default => null
    };

    if ($proxima_etapa) {
        $sql = "UPDATE pacientes SET etapa = '$proxima_etapa' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Paciente avançado para a etapa: $proxima_etapa";
        } else {
            echo "Erro ao avançar paciente: " . $conn->error;
        }
    } else {
        echo "Etapa inválida.";
    }
}
?>
