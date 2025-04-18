<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatable/datatables.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/select2/select2.full.min.js') }}"></script>
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
        const userQuestion = userInput.value;
        userInput.value = "";

        // Auto-scroll al último mensaje
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Envía la petición al asistente
        fetch('/ask-assistant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    question: userQuestion // Cambiado de 'message' a 'question' para coincidir con la validación
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
                // Respuesta del bot
                const botMessage = document.createElement("div");
                botMessage.classList.add("message", "bot-message");

                // Usamos data.answer en lugar de data.response
                botMessage.textContent = data.answer || "No pude obtener una respuesta";
                chatMessages.appendChild(botMessage);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => {
                console.error('Error:', error);
                const botMessage = document.createElement("div");
                botMessage.classList.add("message", "bot-message");

                // Mostramos el error del servidor si está disponible
                botMessage.textContent = error.error || "Lo siento, hubo un error al procesar tu pregunta";
                chatMessages.appendChild(botMessage);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }

    // Inicializar el chatbot oculto
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("chatbotWidget").style.display = "none";
    });
</script>
