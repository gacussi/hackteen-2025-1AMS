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

// Variável para armazenar mensagens de erro ou sucesso
$message = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Verifica se todos os campos estão preenchidos
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $message = "Todos os campos são obrigatórios.";
    } elseif ($password !== $confirmPassword) {
        // Verifica se as senhas coincidem
        $message = "As senhas não coincidem.";
    } else {
        // Verifica se o nome de usuário ou email já existe no banco de dados
        $sql = "SELECT * FROM usuarios WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = "Nome de usuário ou email já está em uso.";
        } else {
            // Criptografar a senha
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Inserir o novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Criar um cookie ao registrar com sucesso
                setcookie("logged_in", $username, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
                $message = "Usuário registrado com sucesso!";
                // Redireciona para o dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Erro ao registrar usuário.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EstudAI</title>
    <link rel="icon" href="icons/register.ico">
    <link rel="stylesheet" href="style/login.css">
<style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #121212, #1e1e1e); /* Fundo preto com gradiente */
            color: white; /* Texto branco */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
</style>
</head>
<body>
    <header class="header">
        <h1>Estud<span class="highlight">AI</span></h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="chat.html">Chat</a>
            <a href="equipe.html">Equipe</a>
        </nav>
    </header>
    <div class="container">
        <div class="form-box">
            <h2>Registro</h2>
            <?php if (!empty($message)): ?>
                <p style="color: red;"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" placeholder="Digite seu nome de usuário" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>

                <label for="confirm_password">Confirme sua Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha" required>

                <button type="submit">Registrar</button>
            </form>
            <a href="login.php">Já tem uma conta? Faça login</a>
        </div>
    </div>
</body>
</html>
