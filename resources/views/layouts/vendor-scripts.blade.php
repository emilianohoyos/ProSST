<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>
@yield('scripts')
<script>
    // Función para mostrar/ocultar el chatbot
    function toggleChatbot() {
        const chatbotWidget = document.getElementById("chatbotWidget");
        chatbotWidget.style.display = chatbotWidget.style.display === "none" ? "flex" : "none";
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

    // Función para enviar mensajes
    function sendMessage() {
        const userInput = document.getElementById("userInput");
        const chatMessages = document.getElementById("chatMessages");

        // Evita el envío si el campo está vacío
        if (!userInput.value.trim()) return;

        // Agrega el mensaje del usuario al chat
        const userMessage = document.createElement("div");
        userMessage.classList.add("message", "user-message");
        userMessage.textContent = userInput.value;
        chatMessages.appendChild(userMessage);

        // Limpia el campo de entrada
        userInput.value = "";

        // Respuesta del bot
        const botMessage = document.createElement("div");
        botMessage.classList.add("message", "bot-message");
        botMessage.textContent = generateBotResponse(userMessage.textContent);
        chatMessages.appendChild(botMessage);

        // Auto-scroll al último mensaje
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Genera una respuesta simple del bot
    function generateBotResponse(message) {
        if (message.toLowerCase().includes("hola")) {
            return "¡Hola! ¿En qué puedo ayudarte?";
        } else if (message.toLowerCase().includes("adiós")) {
            return "¡Hasta luego!";
        } else {
            return "Soy un bot simple. ¿Tienes alguna otra consulta?";
        }
    }

    // Inicializar el chatbot oculto
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("chatbotWidget").style.display = "none";
    });
</script>
