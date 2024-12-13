<?php
// Configurações do banco de dados
$host = 'localhost';       // Nome do host do servidor (geralmente 'localhost')
$user = 'root';            // Nome do usuário do banco de dados
$password = '';            // Senha do banco de dados (deixe vazio se não houver senha)
$dbname = 'upa24h';        // Nome do banco de dados

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}
?>
