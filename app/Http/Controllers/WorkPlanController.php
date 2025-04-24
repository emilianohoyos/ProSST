<?php

namespace App\Http\Controllers;

use App\Models\ApplicationLevel;
use App\Models\PesvAssessment;
use App\Models\WorkPlan;
use App\Models\WorkPlanActivity;
use App\Models\WorkPlanAnswers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WorkPlanController extends Controller
{

    public function generateWorkPlan(Request $request, $assessment_id)
    {
        if (WorkPlan::where('pesv_assessment_id', $assessment_id)->exists()) {
            return response()->json(['status' => false,  'message' => 'Ya existe Plan de trabajo para este diagnostico']);
        }
        $assessment = PesvAssessment::select('client_id', 'application_level_id')->find($assessment_id);
        $level = ApplicationLevel::find($assessment->application_level_id);
        $activities = WorkPlanActivity::select('id')->where('application_level', 'ilike', "%$level->name_level%")->orderBy('id')->get();

        // dd($activities, $level->name_level);

        $work_plan = WorkPlan::create([
            'start_date' => $request->start_date,
            'end_date' => Carbon::parse($request->start_date)->addYear(),
            'preparation_date' => $request->preparation_date,
            'name_president_committee' => $request->preparation_date,
            'reviewed_by' => $request->preparation_date,
            'approved_by' => $request->preparation_date,
            'objective' => 'Cumplir con la Implementacion del PESV, de acuerdo con la normatividad vigente, de forma que se logre una reducción en los siniestros viales.',
            'meta_description' => 'Ejecutar por lo menos el 90% de las actividades programadas en el Plan de trabajo de Seguridad Vial',
            'meta_numeric' => 90,
            'user_id' => Auth::id(),
            'client_id' => $assessment->client_id,
            'application_level_id'  => $assessment->application_level_id,
            'pesv_assessment_id' => $assessment_id
        ]);
        foreach ($activities as $item) {
            WorkPlanAnswers::create([
                'work_plan_id' => $work_plan->id,
                'work_plan_activity_id' => $item->id,
            ]);
        }


        return response()->json(['status' => true,  'message' => 'Se ha generado el plan de trabajo']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('work_plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $work_plan_answer_id)
    {
        $items_work_plan = WorkPlanAnswers::select(
            'work_plan_answers.id',
            'work_plan_activities.activity',
            'work_plan_activities.responsible',
            'work_plan_activities.verify_mode',
            'month_1',
            'month_2',
            'month_3',
            'month_4',
            'month_5',
            'month_6',
            'month_7',
            'month_8',
            'month_9',
            'month_10',
            'month_11',
            'month_12',
            'resource_physical',
            'resource_economic',
            'resource_human',
            'follow_up',
        )
            ->join('work_plan_activities', 'work_plan_answers.work_plan_activity_id', 'work_plan_activities.id')
            ->find($work_plan_answer_id);

        return response()->json(['status' => true, 'data' => $items_work_plan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [];

        // Mapear meses
        foreach (range(1, 12) as $month) {
            $data["month_$month"] = $request->has("month_$month");
        }

        // Mapear recursos
        $resources = ['physical', 'economic', 'human'];
        foreach ($resources as $resource) {
            $data["resource_$resource"] = $request->has("resource_$resource");
        }

        // Actualizar solo si el campo existe en el request
        if ($request->has('follow_up')) {
            $data['follow_up'] = $request->follow_up;
        }

        WorkPlanAnswers::findOrFail($id)->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function datatableWorkPlan()
    {
        $query = PesvAssessment::select([
            'pesv_assessments.id as assessment_id',
            'pesv_assessments.assessment_type_id',
            'pesv_assessments.state_id',
            'pesv_assessments.completed_at',
            'clients.name as client_name',
            'application_levels.name_level',
            'states.name as state_name',
            'assessment_types.name as assessment_types',

        ])
            ->join('clients', 'pesv_assessments.client_id', '=', 'clients.id')
            ->join('application_levels', 'pesv_assessments.application_level_id', '=', 'application_levels.id')
            ->join('states', 'pesv_assessments.state_id', '=', 'states.id')
            ->join('assessment_types', 'pesv_assessments.assessment_type_id', '=', 'assessment_types.id')
            ->rightJoin('work_plans', 'pesv_assessments.id', 'work_plans.pesv_assessment_id')
            ->where('pesv_assessments.user_id', Auth::id())
            ->where('states.name', 'Finalizado')
            ->orderBy('pesv_assessments.id', 'desc')
            ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($assessment) {
                $html = '';

                $html = '

              
                    <a href="' . route('work.plan.answer', $assessment->assessment_id) . '" class="btn btn-sm btn-warning" title="Diligenciar Plan de trabajo">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="' . route('improvement.word', $assessment->assessment_id) . '" class="btn btn-sm btn-danger delete-btn title="descargar Plan de trabajo">
                        <i class="fas fa-file-alt"></i></i>
                    </a>
                    
                ';
                return $html;
            })
            ->editColumn('completed_at', function ($assessment) {
                return Carbon::parse($assessment->completed_at)->format('Y/m/d');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function indexAnswer($assessment_id)
    {
        $work_plan = WorkPlan::where('pesv_assessment_id', $assessment_id)->first();
        $work_plan_id = $work_plan->id;
        $fechaInicio =  Carbon::parse($work_plan->start_date);

        // Generar array de meses para el cronograma
        $mesesCronograma = [];
        for ($i = 0; $i < 12; $i++) {
            $mesFecha = $fechaInicio->copy()->addMonths($i);
            $mesesCronograma[] = [
                'nombre' => $mesFecha->isoFormat('MMM'), // Abreviatura del mes (Ene, Feb, etc.)
                'mes' => $mesFecha->month,
                'año' => $mesFecha->year,
                'completo' => $mesFecha->isoFormat('MMMM YYYY') // Nombre completo del mes
            ];
        }
        return view('work_plan.answer', compact('work_plan_id', 'mesesCronograma'));
    }

    public function datatableWorkPlanDetails($work_plan_id)
    {
        $items_work_plan = WorkPlanAnswers::select(
            'work_plan_answers.id',
            'work_plan_activities.activity',
            'work_plan_activities.responsible',
            'work_plan_activities.verify_mode',
            'month_1',
            'month_2',
            'month_3',
            'month_4',
            'month_5',
            'month_6',
            'month_7',
            'month_8',
            'month_9',
            'month_10',
            'month_11',
            'month_12',
            'resource_physical',
            'resource_economic',
            'resource_human',
            'follow_up',
        )
            ->join('work_plan_activities', 'work_plan_answers.work_plan_activity_id', 'work_plan_activities.id')
            ->where('work_plan_id', $work_plan_id)
            ->orderBy('work_plan_answers.id')
            ->get();

        return DataTables::of($items_work_plan)
            ->addColumn('action', function ($work_plan_answer) {
                return '
                <button class="btn btn-sm btn-warning" onclick="updateInfo(' . $work_plan_answer->id . ')">
                    <i class="fas fa-pen"></i>
                </button>
            ';
            })
            // Transformar meses booleanos a íconos
            ->editColumn('month_1', fn($item) => $this->formatBoolean($item->month_1))
            ->editColumn('month_2', fn($item) => $this->formatBoolean($item->month_2))
            ->editColumn('month_3', fn($item) => $this->formatBoolean($item->month_3))
            ->editColumn('month_4', fn($item) => $this->formatBoolean($item->month_4))
            ->editColumn('month_5', fn($item) => $this->formatBoolean($item->month_5))
            ->editColumn('month_6', fn($item) => $this->formatBoolean($item->month_6))
            ->editColumn('month_7', fn($item) => $this->formatBoolean($item->month_7))
            ->editColumn('month_8', fn($item) => $this->formatBoolean($item->month_8))
            ->editColumn('month_9', fn($item) => $this->formatBoolean($item->month_9))
            ->editColumn('month_10', fn($item) => $this->formatBoolean($item->month_10))
            ->editColumn('month_11', fn($item) => $this->formatBoolean($item->month_11))
            ->editColumn('month_12', fn($item) => $this->formatBoolean($item->month_12))
            // Transformar recursos booleanos
            ->editColumn('resource_physical', fn($item) => $this->formatBoolean($item->resource_physical))
            ->editColumn('resource_economic', fn($item) => $this->formatBoolean($item->resource_economic))
            ->editColumn('resource_human', fn($item) => $this->formatBoolean($item->resource_human))
            ->rawColumns([
                'action',
                'month_1',
                'month_2',
                'month_3',
                'month_4',
                'month_5',
                'month_6',
                'month_7',
                'month_8',
                'month_9',
                'month_10',
                'month_11',
                'month_12',
                'resource_physical',
                'resource_economic',
                'resource_human'
            ])
            ->make(true);
    }

    // Función auxiliar para formatear valores booleanos
    private function formatBoolean($value, $label = null)
    {
        if ($value) {
            return $label
                ? '<span class="badge badge-success">' . $label . '</span>'  // Verde para true (con etiqueta)
                : '<i class="fas fa-check text-success"></i>';              // Verde para true (ícono)
        }

        return $label
            ? '<span class="badge badge-danger">' . $label . '</span>'      // Rojo para false (con etiqueta)
            : '<i class="fas fa-times text-danger"></i>';                    // Rojo para false (ícono)
    }

    public function dataResumeWorkPlan($work_plan_id)
    {
        $estadisticas = [
            'cumple' => WorkPlanAnswers::where('follow_up', 'CUMPLE')->where('work_plan_id', $work_plan_id)->count(),
            'parcial' => WorkPlanAnswers::where('follow_up', 'CUMPLE PARCIALMENTE')->where('work_plan_id', $work_plan_id)->count(),
            'noCumple' => WorkPlanAnswers::where('follow_up', 'NO CUMPLE')->where('work_plan_id', $work_plan_id)->count(),
            'total' => WorkPlanAnswers::where('work_plan_id', $work_plan_id)->count(),
        ];

        return response()->json(['success' => true, 'data' => $estadisticas]);
    }
}
