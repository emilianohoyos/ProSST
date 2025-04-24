<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Webadmin - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('layouts.head-css')
</head>
<style>
    /* Estilos para el loader */
    .chatbot-loader {
        display: none;
        justify-content: center;
        padding: 10px;
        margin: 5px 0;
    }

    .loader-dots {
        display: flex;
        gap: 6px;
    }

    .loader-dots .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #3498db;
        animation: bounce 1.4s infinite ease-in-out both;
    }

    .loader-dots .dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .loader-dots .dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }
</style>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('layouts.topbar')

    <!-- sidebar components -->
    @include('layouts.sidebar')
    @include('layouts.horizontal')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
{{-- @include('layouts.right-sidebar') --}}

<!-- vendor-scripts -->
@include('layouts.vendor-scripts')
<!-- Botón flotante para abrir el chatbot -->
<div class="chatbot-toggle-btn" onclick="toggleChatbot()">💬</div>

<!-- Contenedor del chatbot flotante -->
<div class="chatbot-widget bg-light shadow" id="chatbotWidget">

    <div class="chatbot-header">
        <span>Chatbot</span>
        <div>
            <button onclick="minimizeChatbot()">_</button>
            <button onclick="closeChatbot()">✖</button>
        </div>
    </div>
    <div class="chatbot-messages" id="chatMessages">
        <!-- Mensajes del chat aparecerán aquí -->

    </div>
    <div class="chatbot-loader" id="chatbotLoader">
        <div class="loader-dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <div class="chatbot-input">
        <input type="text" id="userInput" class="form-control" placeholder="Escribe un mensaje...">
        <button class="btn btn-primary" onclick="sendMessage()">Enviar</button>
    </div>
</div>

</body>

</html>
<script>
    // Función para mostrar/ocultar el chatbot
    function toggleChatbot() {
        const chatbotWidget = document.getElementById("chatbotWidget");
        if (chatbotWidget.style.display === "none") {
            chatbotWidget.style.display = "flex";
            showWelcomeMessage(); // Mostrar mensaje de bienvenida al abrir
        } else {
            chatbotWidget.style.display = "none";
        }
    }

    // Función para minimizar el chatbot (oculta solo el cuerpo del chat)
    function minimizeChatbot() {
        const chatMessages = document.getElementById("chatMessages");
        const chatInput = document.querySelector(".chatbot-input");

        // Alterna la visibilidad del área de mensajes y entrada
        const isVisible = chatMessages.style.display !== "none";
        chatMessages.style.display = isVisible ? "none" : "block";
        chatInput.style.display = isVisible ? "none" : "flex";
    }

    // Función para cerrar completamente el chatbot
    function closeChatbot() {
        document.getElementById("chatbotWidget").style.display = "none";
    }

    function showWelcomeMessage() {
        const chatMessages = document.getElementById("chatMessages");
        const welcomeMessage = document.createElement("div");
        welcomeMessage.classList.add("message", "bot-message");
        welcomeMessage.textContent = "Hola soy ProSSTBot, estoy aquí para ayudarte. ¿Qué dudas tienes del PESV?";
        chatMessages.appendChild(welcomeMessage);
    }
    // Función para enviar mensajes
    function sendMessage() {
        const userInput = document.getElementById("userInput");
        const chatMessages = document.getElementById("chatMessages");
        const loader = document.getElementById("chatbotLoader");

        // Evita el envío si el campo está vacío
        if (!userInput.value.trim()) return;

        // Agrega el mensaje del usuario al chat
        const userMessage = document.createElement("div");
        userMessage.classList.add("message", "user-message");
        userMessage.textContent = userInput.value;
        chatMessages.appendChild(userMessage);

        // Limpia el campo de entrada
        const userQuestion = userInput.value;
        userInput.value = "";

        // Auto-scroll al último mensaje
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Muestra el loader
        loader.style.display = 'flex';

        // Deshabilita el botón de enviar temporalmente
        const sendBtn = document.querySelector('.chatbot-input button');
        sendBtn.disabled = true;

        // Envía la petición al asistente
        fetch('/ask-assistant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    question: userQuestion
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                // Crea y muestra la respuesta del bot
                const botMessage = document.createElement("div");
                botMessage.classList.add("message", "bot-message");
                botMessage.textContent = data.answer || "No pude obtener una respuesta";
                chatMessages.appendChild(botMessage);
            })
            .catch(error => {
                console.error('Error:', error);
                const botMessage = document.createElement("div");
                botMessage.classList.add("message", "bot-message");
                botMessage.textContent = error.error || "Lo siento, hubo un error al procesar tu pregunta";
                chatMessages.appendChild(botMessage);
            })
            .finally(() => {
                // Oculta el loader y habilita el botón
                loader.style.display = 'none';
                sendBtn.disabled = false;
                // Auto-scroll al final después de recibir respuesta
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }
    // Inicializar el chatbot oculto
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("chatbotWidget").style.display = "none";
    });
</script>
