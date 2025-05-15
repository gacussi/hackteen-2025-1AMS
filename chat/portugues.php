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
    <title>Chat de Portugues - EstudAI</title>
    <link rel="icon" href="icons/portugues.ico">
    <link rel="stylesheet" href="css/chat.css">
<style>
.back-button {
    margin-top: 20px;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    background-color: #6a0dad; /* Roxo médio */
    color: white; /* Texto branco */
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
.back-button:hover {
    background-color: #7942ba; /* Roxo claro */
    transform: scale(1.05); /* Efeito de leve aumento */
}
</style>
</head>
<body>
  <div class="chat-container">
        <!-- Cabeçalho com menu -->
        <div class="header">
            <h2>Chat de Portugues</h2>
       </div>

        <!-- Área de mensagens -->
        <div class="message-area" id="message-area"></div>

        <!-- Formulário de envio de mensagens -->
        <form class="send-message-form" onsubmit="sendMessage(event)">
            <input type="text" id="message" placeholder="Digite sua mensagem...">
            <button type="submit">Enviar</button>
        </form>
    <button class="back-button" onclick="window.location.href='../dashboard.php'">Voltar ao Dashboard</button>

    </div>
</div>>

    <script>
        // Alternar visibilidade do menu
        function toggleMenu() {
            const menu = document.getElementById('menuDropdown');
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }

        // Atualizar e exibir mensagens
        function fetchMessages() {
            fetch('php/fetch_messages_portugues.php') // Arquivo específico para Geografia
                .then(response => response.json())
                .then(data => {
                    const chatContainer = document.getElementById('message-area');
                    chatContainer.innerHTML = '';
                    data.forEach(msg => {
                        const messageDiv = document.createElement('div');
                        messageDiv.classList.add('message');
                        messageDiv.innerHTML = `<span>${msg.username}:</span><p>${msg.mensagem}</p>`;
                        chatContainer.appendChild(messageDiv);
                    });
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
        }

        // Enviar mensagens
        function sendMessage(event) {
            event.preventDefault();
            const messageInput = document.getElementById('message');
            const message = messageInput.value.trim();
            if (message) {
                fetch('php/send_messages_portugues.php', { // Arquivo específico para Geografia
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ mensagem: message })
                }).then(() => {
                    messageInput.value = '';
                    fetchMessages();
                });
            }
        }

        // Inicializar fetch de mensagens
        document.addEventListener('DOMContentLoaded', () => {
            fetchMessages();
            setInterval(fetchMessages, 1000); // Atualiza a cada 1 segundo
        });
    </script>
</body>
</html>
