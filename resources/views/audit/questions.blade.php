@extends('layouts.master')
@section('title')
    Auditoria PESV
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Auditoria PESV
@endsection
@section('body')
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $step->description }}</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <input type="hidden" name="assessment_id" id="assessment_id" value="{{ $assessment_id }}">
                                @foreach ($questions as $item)
                                @php
                                 $existingAnswer = $existingAnswers[$item->id] ?? null;
                                @endphp
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <!-- Pregunta y selector de respuesta -->
                                        <label for="question{{$item->id}}" class="form-label">Pregunta N. {{$item->order}}.{{$item->question}}</label>
                                        <select name="question{{$item->id}}" 
                                                class="form-control answer-select @error('question{{$item->id}}') is-invalid @enderror" 
                                                id="question{{$item->id}}"
                                                data-question-id="{{$item->id}}">
                                            <option value="">Seleccione una respuesta</option>
                                            @foreach ($options as $option)
                                                <option value="{{ $option->id }}" {{ old('client_id') == $option->name ? 'selected' : '' }}  @if($existingAnswer && $existingAnswer->qualification_id == $option->id) selected @endif>
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="feedback-message" id="feedback-answer-{{$item->id}}"></div>
                                        
                                        <!-- Campo de observaciones para esta pregunta -->
                                        <div class="mt-2">
                                            <label for="observacion{{$item->id}}" class="form-label">Observaciones (opcional)</label>
                                            <textarea class="form-control observacion-field" 
                                                    id="observacion{{$item->id}}" 
                                                    name="observacion{{$item->id}}"
                                                    rows="2"
                                                    data-question-id="{{$item->id}}"
                                                    placeholder="Agregue notas adicionales si es necesario">{{ old('observacion'.$item->id) }}@if($existingAnswer){{ $existingAnswer->observation }}@endif</textarea>
                                            <div class="feedback-message" id="feedback-observacion-{{$item->id}}"></div>
                                        </div>
                                        
                                        @error('client_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                        
                                <div class="d-grid gap-2">
                                    <a href="{{ route('audit.edit', $assessment_id) }}" class="btn btn-primary btn-lg waves-effect waves-light">
                                        Volver
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
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
        const observacionField = document.querySelector(`.observacion-field[data-question-id="${questionId}"]`);
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

    fetch('{{ route("audit.save.single.response") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        feedbackElement.textContent = type === 'answer' ? 'Respuesta guardada' : 'Observación guardada';
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

  
