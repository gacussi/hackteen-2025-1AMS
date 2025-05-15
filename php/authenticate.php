<?php
// Inicie a sessão
session_start();

// Configuração de conexão com o banco de dados
$host = 'localhost'; // Altere para o endereço do seu servidor
$dbname = 'estudai'; // Nome do banco de dados
$username = 'gacussi'; // Nome de usuário do banco de dados
$password = 'Gui10davi'; // Senha do banco de dados

try {
    // Conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Verifica se os campos estão preenchidos
    if (empty($user) || empty($pass)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Consulta no banco de dados para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $user);
    $stmt->execute();

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data && password_verify($pass, $user_data['password'])) {
        // Login bem-sucedido, armazena informações do usuário na sessão
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];

        // Redireciona para a página inicial ou dashboard
        header("Location: chat.php");
        exit;
    } else {
        // Login falhou
        echo "Usuário ou senha inválidos.";    }
}
?>
