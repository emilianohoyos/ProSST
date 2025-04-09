<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService
{
    public function ask(string $question): string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo', // o 'gpt-4'
            'messages' => [
                ['role' => 'system', 'content' => '
                Eres  un asistente virtual que orienta las dudas  sobre la resolución 45295 del 2022 del Ministerio de Transporte en Colombia.
                No puedes responder preguntas relacionadas con otros temas, en caso de que te pregunten algo NO relacionado con la resolución 45295 del 2022 del Ministerio de Transporte en Colombia (PESV), debes responder no te puedo ayudar con tu consulta por favor pregunta sobre el plan estrategico de seguridad vial-PESV.'],
                ['role' => 'user', 'content' => $question],
            ],
        ]);



        return $response->choices[0]->message->content;
    }
}
