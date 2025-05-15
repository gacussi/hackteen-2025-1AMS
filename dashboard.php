<?php
if (!isset($_COOKIE['logged_in'])) {
    header("Location: error.php");
    exit;
}

$username = $_COOKIE['logged_in'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EstudAI</title>
    <link rel="icon" href="icons/dashboard.ico">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
        .container {
            background: #6a0dad; /* Fundo roxo */
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); /* Sombra mais escura */
            width: 90%;
            max-width: 400px;
        }
        button {
            padding: 12px;
            border-radius: 10px;
            border: none;
            margin: 10px 0;
            width: 100%;
            font-size: 16px;
            background-color: #7942ba; /* Roxo médio */
            color: white; /* Texto branco */
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #9575cd; /* Roxo claro */
            transform: scale(1.05); /* Efeito de leve aumento */
        }
        h2 {
            color: #ffffff; /* Branco puro para maior destaque */
            margin-bottom: 10px;
        }
        p {
            color: #dcdcdc; /* Cinza claro */
            margin-bottom: 20px;
        }
    </style>
    <script>
        function irParaChat(chat) {
            const links = {
                "Matemática": "chat/matematica.php",
                "Língua Portuguesa": "chat/portugues.php",
                "História": "chat/historia.php",
                "Geografia": "chat/geografia.php"
            };
            if (links[chat]) {
                window.location.href = links[chat];
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?= htmlspecialchars($username) ?>!</h2>
        <p>Escolha o chat para entrar:</p>
        <button onclick="irParaChat('Matemática')">📐 Matemática</button>
        <button onclick="irParaChat('Língua Portuguesa')">📖 Língua Portuguesa</button>
        <button onclick="irParaChat('História')">📜 História</button>
        <button onclick="irParaChat('Geografia')">🌍 Geografia</button>
    </div>
</body>
</html>
