<?php
header('Content-Type: application/json');
require_once 'db_connection.php'; // Arquivo para conexão com o banco de dados

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['mensagem']) && isset($_COOKIE['logged_in'])) {
    $stmt = $pdo->prepare("INSERT INTO chat_matematica (username, mensagem) VALUES (:username, :mensagem)");
    $stmt->execute([
        ':username' => $_COOKIE['logged_in'],
        ':mensagem' => $data['mensagem']
    ]);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Mensagem ou autenticação ausente.']);
}
?>
