<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AssistantService
{
    protected string $assistantId = 'asst_QWLNIvxtmogznSHxOfyt7eZX';

    // Crea un hilo de conversación
    public function createThread(): string
    {
        $response = OpenAI::threads()->create([]);
        return $response->id; // Retorna el ID del hilo
    }

    // Envía una pregunta al asistente
    public function askAboutPESV(string $threadId, string $question): string
    {
        // 1. Envía la pregunta al hilo
        OpenAI::threads()->messages()->create($threadId, [
            'role' => 'user',
            'content' => $question,
        ]);

        // 2. Inicia la ejecución del asistente
        $run = OpenAI::threads()->runs()->create(
            threadId: $threadId,
            parameters: [
                'assistant_id' => $this->assistantId,
            ]
        );

        // 3. Espera la respuesta (con timeout de 25 segundos)
        $maxAttempts = 25;
        $attempts = 0;

        do {
            $runStatus = OpenAI::threads()->runs()->retrieve(
                threadId: $threadId,
                runId: $run->id
            );

            if ($runStatus->status === 'failed' || $attempts >= $maxAttempts) {
                throw new \Exception("El asistente no respondió a tiempo.");
            }

            sleep(1);
            $attempts++;
        } while ($runStatus->status !== 'completed');

        // 4. Obtiene el último mensaje del asistente
        $messages = OpenAI::threads()->messages()->list($threadId, ['limit' => 1]);
        return $messages->data[0]->content[0]->text->value;
    }
}
