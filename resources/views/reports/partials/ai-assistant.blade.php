<div class="ai-assistant-container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-robot me-2"></i>Asistente de Reportes
            </h5>
            <button class="btn btn-sm btn-light toggle-ai-assistant">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="card-body ai-assistant-body" style="display: none;">
            <!-- Contenido del chat -->
            <div id="ai-chat-container" style="height: 300px; overflow-y: auto; margin-bottom: 15px;"></div>
            <form class="ai-assistant-form">
                @csrf
                <input type="hidden" name="report_context" value="{{ $reportContext ?? '' }}">
                <div class="input-group">
                    <input type="text" class="form-control ai-question-input"
                        placeholder="Pregunta sobre este reporte..." required>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Alternar visibilidad
            document.querySelectorAll('.toggle-ai-assistant').forEach(btn => {
                btn.addEventListener('click', function() {
                    const body = this.closest('.card').querySelector('.ai-assistant-body');
                    body.style.display = body.style.display === 'none' ? 'block' : 'none';
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });

            // Enviar pregunta
            document.querySelectorAll('.ai-assistant-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const container = this.closest('.ai-assistant-container');
                    const question = container.querySelector('.ai-question-input').value.trim();
                    const context = container.querySelector('input[name="report_context"]').value;

                    if (question) {
                        addAIMessage(container, question, 'user');
                        container.querySelector('.ai-question-input').value = '';

                        // Mostrar indicador de carga
                        addAIMessage(container, 'Procesando tu pregunta...', 'bot', true);

                        // Enviar al servidor
                        fetch('{{ route('ai.assistant.query') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    question: question,
                                    context: context
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                container.querySelector('.typing-indicator')?.remove();
                                if (data.success) {
                                    addAIMessage(container, data.answer, 'bot');
                                } else {
                                    addAIMessage(container, 'Error: ' + data.message, 'bot');
                                }
                            })
                            .catch(error => {
                                container.querySelector('.typing-indicator')?.remove();
                                addAIMessage(container, 'Error de conexión', 'bot');
                            });
                    }
                });
            });

            function addAIMessage(container, text, sender, isTyping = false) {
                const chatContainer = container.querySelector('#ai-chat-container');
                const time = new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                const message = document.createElement('div');

                if (isTyping) {
                    message.className = 'typing-indicator mb-2 text-start';
                    message.innerHTML = `
                <div class="d-inline-block p-2 rounded-3 bg-light">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <small class="text-muted">${time}</small>
            `;
                } else {
                    const bubbleClass = sender === 'user' ? 'bg-primary text-white' : 'bg-light';
                    const icon = sender === 'user' ? 'fas fa-user' : 'fas fa-robot';
                    const alignClass = sender === 'user' ? 'text-end' : 'text-start';

                    message.className = `mb-2 ${alignClass}`;
                    message.innerHTML = `
                <div class="d-inline-flex align-items-end">
                    ${sender === 'bot' ? `<i class="${icon} me-2 mb-1"></i>` : ''}
                    <div class="p-2 rounded-3 ${bubbleClass}">
                        ${text}
                    </div>
                    ${sender === 'user' ? `<i class="${icon} ms-2 mb-1"></i>` : ''}
                </div>
                <small class="text-muted d-block" style="font-size: 0.7rem;">${time}</small>
            `;
                }

                chatContainer.appendChild(message);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });
    </script>

    <style>
        .ai-assistant-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            z-index: 1000;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .ai-assistant-container .card-header {
            cursor: pointer;
        }

        .ai-assistant-body {
            padding: 15px;
        }

        #ai-chat-container {
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
            min-height: 100px;
        }

        #ai-chat-container .bg-primary {
            max-width: 80%;
            margin-left: auto;
        }

        #ai-chat-container .bg-light {
            max-width: 80%;
        }

        .typing-dots span {
            width: 6px;
            height: 6px;
            margin: 0 1px;
            background-color: #6c757d;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .typing-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dots span:nth-child(2) {
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
@endpush
