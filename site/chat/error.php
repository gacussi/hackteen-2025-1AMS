<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado - EstudAI</title>
    <link rel="icon" href="icons/error.ico">
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
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #ffffff; /* Branco puro */
        }
        p {
            font-size: 16px;
            color: #dcdcdc; /* Cinza claro */
            margin-bottom: 20px;
        }
        button {
            padding: 12px;
            border-radius: 10px;
            border: none;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Acesso Negado</h1>
        <p>Você precisa estar logado para acessar esta página.</p>
        <button onclick="window.location.href='../login.php'">🔒 Ir para Login</button>
    </div>
</body>
</html>
