<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Gerar uma senha única para o paciente
    $senha_atendimento = strtoupper(substr(md5(time()), 0, 5));

    $sql = "INSERT INTO pacientes (nome_completo, cpf, telefone, endereco, senha_atendimento)
            VALUES ('$nome_completo', '$cpf', '$telefone', '$endereco', '$senha_atendimento')";

    if ($conn->query($sql) === TRUE) {
        echo "Paciente cadastrado com sucesso! Senha: $senha_atendimento";
    } else {
        echo "Erro ao cadastrar paciente: " . $conn->error;
    }
}
?>
