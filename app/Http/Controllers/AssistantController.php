<?php

namespace App\Http\Controllers;

use App\Services\AssistantService;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    protected AssistantService $assistant;

    public function __construct(AssistantService $assistant)
    {
        $this->assistant = $assistant;
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        try {
            $threadId = $this->assistant->createThread();
            $answer = $this->assistant->askAboutPESV($threadId, $request->question);

            return response()->json([
                'answer' => $answer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
