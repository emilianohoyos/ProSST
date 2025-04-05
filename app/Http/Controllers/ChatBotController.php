<?php

namespace App\Http\Controllers;

use App\Services\ChatGPTService;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    protected $chatGPT;

    public function __construct(ChatGPTService $chatGPT)
    {
        $this->chatGPT = $chatGPT;
    }

    public function ask(Request $request)
    {
        $question = $request->input('question');
        $answer = $this->chatGPT->ask($question);

        return response()->json(['answer' => $answer]);
    }
}
