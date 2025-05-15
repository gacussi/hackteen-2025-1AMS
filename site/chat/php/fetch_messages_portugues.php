<?php
header('Content-Type: application/json');
require_once 'db_connection.php'; // Arquivo para conexão com o banco de dados

$stmt = $pdo->query("SELECT username, mensagem, data_envio FROM chat_portugues ORDER BY data_envio ASC");
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($mensagens);
?>
