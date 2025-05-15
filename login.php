<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$dbname = 'estudai';
$username = 'gacussi';
$password = 'Gui10davi';

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
    $userOrEmail = $_POST['user_or_email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($userOrEmail) || empty($password)) {
        $message = "Todos os campos são obrigatórios.";
    } else {
        // Busca o usuário pelo nome de usuário ou email
        $sql = "SELECT * FROM usuarios WHERE username = :userOrEmail OR email = :userOrEmail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userOrEmail', $userOrEmail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e a senha está correta
        if ($user && password_verify($password, $user['password'])) {
            // Cria o cookie de autenticação
            setcookie("logged_in", $user['username'], time() + (86400 * 30), "/"); // Cookie válido por 30 dias
            header("Location: dashboard.php"); // Redireciona para o dashboard
            exit;
        } else {
            $message = "Usuário ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EstudAI</title>
    <link rel="icon" href="icons/favicon.ico">
    <link rel="stylesheet" href="style/login.css"> <!-- Reutilizando o mesmo CSS -->
    <style>
        /* Estilos gerais */
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

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

        /* Cabeçalho */
        .header {
          position: fixed; /* Fixa no topo */
          top: 0;
          width: 100%; /* Ocupa toda a largura */
          background-color: #6C2CC0; /* Fundo roxo */
          padding: 10px 20px;
          display: flex;
          justify-content: space-between;
          align-items: center;
          z-index: 1000;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra para destaque */
        }

        .header h1 {
          font-size: 1.8rem;
          color: white;
        }

        .header .highlight {
          color: #E8E6E3; /* Destaque claro */
        }

        .header nav {
          display: flex;
          gap: 15px;
        }

        .header nav a {
          color: white;
          text-decoration: none;
          font-size: 1rem;
        }

        .header nav a:hover {
          text-decoration: underline;
        }

        /* Container principal */
        .container {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          height: 100%;
          margin-top: 60px; /* Espaço para o cabeçalho fixo */
        }

        /* Formulário */
        .form-box {
          background-color: rgba(0, 0, 0, 0.8); /* Fundo semitransparente */
          padding: 40px;
          border-radius: 10px;
          max-width: 400px;
          width: 100%;
          text-align: center;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .form-box h2 {
          margin-bottom: 20px;
          color: #6C2CC0; /* Cor do título */
        }

        .form-box label {
          display: block;
          text-align: left;
          margin: 10px 0 5px;
        }

        .form-box input {
          width: 100%;
          padding: 10px;
          margin-bottom: 20px;
          border: none;
          border-radius: 5px;
          background-color: #2C2C2C; /* Fundo do input */
          color: white;
        }

        .form-box button {
          width: 100%;
          padding: 10px;
          background-color: #6C2CC0;
          color: white;
          border: none;
          border-radius: 5px;
          font-size: 1rem;
          cursor: pointer;
          transition: background-color 0.3s ease;
        }

        .form-box button:hover {
          background-color: #503C6B;
        }

        .form-box a {
          display: block;
          margin-top: 20px;
          color: #6C2CC0;
          text-decoration: none;
        }

        .form-box a:hover {
          text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="header">
        <h1>Estud<span class="highlight">AI</span></h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="chat.html">Chat</a>
            <a href="equipe.html">Equipe</a>
        </nav>
    </header>

    <!-- Formulário de Login -->
    <div class="container">
        <div class="form-box">
            <h2>Login</h2>
            <?php if (!empty($message)): ?>
                <p style="color: red;"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <label for="user_or_email">Usuário ou Email:</label>
                <input type="text" id="user_or_email" name="user_or_email" placeholder="Digite seu usuário ou email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>

                <button type="submit">Entrar</button>
            </form>
            <a href="register.php">Não tem uma conta? Registre-se</a>
        </div>
    </div>
</body>
</html>
