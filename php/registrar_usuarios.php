<?php
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
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Verifica se todos os campos estão preenchidos
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Verifica se as senhas coincidem
    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Verifica se o nome de usuário ou email já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Nome de usuário ou email já está em uso.";
        exit;
    }

    // Criptografar a senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Inserir o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro ao registrar usuário.";
    }
}
?>
