// Atualização de mensagens
document.addEventListener('DOMContentLoaded', () => {
    const messagesContainer = document.getElementById('messages');

    // Simulação de recebimento de mensagens
    function addMessage(username, text) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.innerHTML = `<span class="username">${username}:</span> <span class="text">${text}</span>`;
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // Rolagem automática
    }

    // Função para buscar mensagens do servidor (substituir pela lógica real)
    function fetchMessages() {
        // Simulando fetch com mensagens fictícias
        const simulatedMessages = [
            { username: 'EstudAI', text: 'Bem-vindo ao chat!' },
            { username: 'Usuário1', text: 'Olá, tudo bem?' },
            { username: 'Usuário2', text: 'Sim, e você?' },
        ];

        // Adicionando mensagens simuladas
        simulatedMessages.forEach(msg => addMessage(msg.username, msg.text));
    }

    // Atualizar mensagens a cada 5 segundos
    setInterval(fetchMessages, 5000);

    // Carregar mensagens iniciais
    fetchMessages();
});

// Partículas de fundo (usando particles.js ou configuração manual)
document.addEventListener('DOMContentLoaded', () => {
    // Configuração de partículas
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800,
                },
            },
            color: {
                value: '#4CAF50',
            },
            shape: {
                type: 'circle',
                stroke: {
                    width: 0,
                    color: '#000000',
                },
                polygon: {
                    nb_sides: 5,
                },
            },
            opacity: {
                value: 0.5,
                random: false,
                anim: {
                    enable: false,
                    speed: 1,
                    opacity_min: 0.1,
                    sync: false,
                },
            },
            size: {
                value: 3,
                random: true,
                anim: {
                    enable: false,
                    speed: 40,
                    size_min: 0.1,
                    sync: false,
                },
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: '#4CAF50',
                opacity: 0.4,
                width: 1,
            },
            move: {
                enable: true,
                speed: 6,
                direction: 'none',
                random: false,
                straight: false,
                out_mode: 'out',
                bounce: false,
                attract: {
                    enable: false,
                    rotateX: 600,
                    rotateY: 1200,
                },
            },
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: true,
                    mode: 'repulse',
                },
                onclick: {
                    enable: true,
                    mode: 'push',
                },
                resize: true,
            },
            modes: {
                grab: {
                    distance: 400,
                    line_linked: {
                        opacity: 1,
                    },
                },
                bubble: {
                    distance: 400,
                    size: 40,
                    duration: 2,
                    opacity: 8,
                    speed: 3,
                },
                repulse: {
                    distance: 200,
                    duration: 0.4,
                },
                push: {
                    particles_nb: 4,
                },
                remove: {
                    particles_nb: 2,
                },
            },
        },
        retina_detect: true,
    });
});
