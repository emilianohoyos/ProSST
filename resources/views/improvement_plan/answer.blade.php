@extends('layouts.master')
@section('title')
    Plan de mejora PESV
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Plan de mejora PESV
@endsection
@section('body')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Plan de mejora PESV</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <!-- table mb-0-->

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Tipo de accion</th>
                                    <th>Fuente</th>
                                    <th>Desc. situacion detectada</th>
                                    <th>Analisis de causas</th>
                                    <th>Accion de mejora a emprender</th>
                                    <th>¿La Accion De Mejora Fue Eficaz?</th>
                                    <th>Estado de la accion </th>
                                    <th>Mecanismo utilizado para difundir la accion </th>
                                    <th>Observacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form>
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="assessment_id" id="assessment_id"
                                            value="{{ $assessment_id }}">
                                        @foreach ($preguntas_cero_cumplimiento as $item)
                                        @endforeach


                                    </div>
                                </form>

                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('audit.edit', $assessment_id) }}"
                            class="btn btn-primary btn-lg waves-effect waves-light">
                            Volver
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@endsection
@section('scripts')
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar cambios en las respuestas
        document.querySelectorAll('.answer-select').forEach(select => {
            select.addEventListener('change', function() {
                saveAnswer(this.dataset.questionId, this.value, 'answer');
            });
        });

        // Manejar cambios en observaciones (con debounce)
        document.querySelectorAll('.observacion-field').forEach(textarea => {
            let timeout;
            textarea.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    saveAnswer(this.dataset.questionId, this.value, 'observation');
                }, 800);
            });
        });

        function saveAnswer(questionId, value, type) {
            const assessmentId = document.getElementById('assessment_id').value;
            const feedbackElement = document.getElementById(`feedback-${type}-${questionId}`);

            feedbackElement.textContent = 'Guardando...';
            feedbackElement.style.color = 'blue';

            // Construir el payload correctamente
            const payload = {
                assessment_id: assessmentId,
                question_id: questionId
            };

            // Agregar el campo correcto según el tipo
            if (type === 'answer') {
                payload.option_id = value;
                // Si también quieres enviar la observación cuando cambia la respuesta
                const observacionField = document.querySelector(
                    `.observacion-field[data-question-id="${questionId}"]`);
                if (observacionField && observacionField.value) {
                    payload.observation = observacionField.value;
                }
            } else {
                payload.observation = value;
                // Si también quieres enviar la respuesta cuando cambia la observación
                const answerField = document.querySelector(`.answer-select[data-question-id="${questionId}"]`);
                if (answerField && answerField.value) {
                    payload.option_id = answerField.value;
                }
            }

            fetch('{{ route('audit.save.single.response') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    feedbackElement.textContent = type === 'answer' ? 'Respuesta guardada' :
                        'Observación guardada';
                    feedbackElement.style.color = 'green';
                })
                .catch(error => {
                    feedbackElement.textContent = 'Error al guardar';
                    feedbackElement.style.color = 'red';
                    console.error('Error:', error);
                });
        }

    });
</script>
@endsection
