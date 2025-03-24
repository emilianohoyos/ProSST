<?php

namespace App\Http\Controllers;

use App\Models\ApplicationLevel;
use App\Models\ClientUser;
use App\Models\PesvAnswer;
use App\Models\PesvAssessment;
use App\Models\PesvQuestion;
use App\Models\PesvSummary;
use App\Models\Qualification;
use App\Models\Steps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Level;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Facades\DataTables;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = false;
        return view('audit.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = ApplicationLevel::all();
        $users = ClientUser::where('user_id', Auth::id())
            ->join('clients', 'client_users.user_id', 'clients.id')->get();

        return view('audit.create', compact('users', 'levels'));
    }

    public function assessment()
    {

        return view('audit.form-wizard');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'completed_at' => 'required|date',
            'number_vehicles' => 'required|integer|min:1',
            'application_level_id' => 'required|exists:application_levels,id',
        ]);

        PesvAssessment::create([
            'client_id' =>  $request->client_id,
            'completed_at' => $request->completed_at,
            'number_vehicles' => $request->number_vehicles,
            'application_level_id' => $request->application_level_id,
            'user_id' => Auth::id(),
            'state_id' => 1
        ]);

        $status = true;

        return to_route('audit.index', compact('status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $audit = PesvAssessment::select('application_levels.name_level')
            ->join('application_levels', 'pesv_assessments.application_level_id', 'application_levels.id')
            ->find($id);


        return view('audit.steps')->with(['application_level' => $audit->name_level, 'assessment_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




    public function datatableAuditoria()
    {
        $query = PesvAssessment::select([
            'pesv_assessments.id as assessment_id',
            'pesv_assessments.completed_at',
            'clients.name as client_name',
            'application_levels.name_level',
            'states.name as state_name'
        ])
            ->join('clients', 'pesv_assessments.client_id', '=', 'clients.id')
            ->join('application_levels', 'pesv_assessments.application_level_id', '=', 'application_levels.id')
            ->join('states', 'pesv_assessments.state_id', '=', 'states.id')
            ->where('pesv_assessments.user_id', 1)
            ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($assessment) {
                return '
                    <a href="' . route('audit.show', $assessment->assessment_id) . '" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="' . route('audit.edit', $assessment->assessment_id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="' . $assessment->assessment_id . '">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->editColumn('completed_at', function ($assessment) {
                return Carbon::parse($assessment->completed_at)->format('Y/m/d');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function datatablePasos($application_level, $assessment_id)
    {
        // Consulta optimizada para obtener total de preguntas y respondidas
        $stepsData = PesvQuestion::leftJoin('pesv_answers', function ($join) use ($assessment_id) {
            $join->on('pesv_questions.id', '=', 'pesv_answers.pesv_question_id')
                ->where('pesv_answers.pesv_assessment_id', $assessment_id)
                ->whereNotNull('pesv_answers.qualification_id');
        })
            ->select(
                'pesv_questions.step_id',
                DB::raw('COUNT(DISTINCT pesv_questions.id) as total_questions'),
                DB::raw('COUNT(DISTINCT pesv_answers.pesv_question_id) as answered_questions')
            )
            ->where('pesv_questions.level', 'ilike', "%$application_level%")
            ->groupBy('pesv_questions.step_id')
            ->get()
            ->keyBy('step_id');

        $steps = Steps::whereIn('id', $stepsData->pluck('step_id'))->get();

        return DataTables::of($steps)
            ->addColumn('total_questions', function ($step) use ($stepsData) {
                return $stepsData[$step->id]->total_questions ?? 0;
            })
            ->addColumn('answered_questions', function ($step) use ($stepsData) {
                return $stepsData[$step->id]->answered_questions ?? 0;
            })
            ->addColumn('progress', function ($step) use ($stepsData) {
                $total = $stepsData[$step->id]->total_questions ?? 1;
                $answered = $stepsData[$step->id]->answered_questions ?? 0;
                $percentage = $total > 0 ? round(($answered / $total) * 100) : 0;

                return $answered . '/' . $total . ' - ' . $percentage . '%';
            })
            ->addColumn('action', function ($step) use ($stepsData, $assessment_id) {
                $total = $stepsData[$step->id]->total_questions ?? 0;
                $answered = $stepsData[$step->id]->answered_questions ?? 0;

                // Mostrar botón solo si no están todas respondidas
                if ($answered < $total) {
                    return '
                        <a href="' . route('audit.step.questions', [
                        'step_id' => $step->id,
                        'assessment_id' => $assessment_id
                    ]) . '" 
                        class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                }

                return ''; // No mostrar botón si todas están respondidas
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function diligenciarPreguntas($assessment_id, $step_id)
    {
        $audit = PesvAssessment::select('application_levels.name_level')
            ->join('application_levels', 'pesv_assessments.application_level_id', 'application_levels.id')
            ->find($assessment_id);
        $questions = PesvQuestion::where('level', 'like', "%$audit->name_level%")
            ->where('step_id', $step_id)->get();
        $step = Steps::find($step_id);

        $options = Qualification::all();

        $existingAnswers = PesvAnswer::where('pesv_assessment_id', $assessment_id)
            ->get()
            ->keyBy('pesv_question_id');


        return view('audit.questions', compact('step', 'questions', 'options', 'assessment_id', 'existingAnswers'));
    }

    public function guardarRespuestaIndividual(Request $request)
    {
        try {
            $validated = $request->validate([
                'assessment_id' => 'required|integer',
                'question_id' => 'required|integer',
                'option_id' => 'required|integer',
                'observation' => 'nullable|string|max:500'  // Hacerlo nullable
            ]);

            // Verificar que al menos uno de los campos esté presente
            if (!isset($validated['option_id'])) {
                $validated['option_id'] = null;
            }
            if (!isset($validated['observation'])) {
                $validated['observation'] = null;
            }

            $respuesta = PesvAnswer::updateOrCreate(
                [
                    'pesv_assessment_id' => $validated['assessment_id'],
                    'pesv_question_id' => $validated['question_id']
                ],
                [
                    'qualification_id' => $validated['option_id'],
                    'observation' => $validated['observation']
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'received_data' => $request->all() // Para debug
            ]);
        }
    }
}
