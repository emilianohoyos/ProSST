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
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;
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
            'name_president_committee' => $request->name_president_committee,
            'reviewed_by' => $request->reviewed_by,
            'approved_by' => $request->approved_by,
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
                    <a href="' . route('work.plan.word', $assessment->assessment_id) . '" class="btn btn-sm btn-danger delete-btn title="descargar Plan de trabajo">
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
            ->orderBy('work_plan_answers.activity')
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


    public function generateWordWorkPlan($assessment_id)
    {
        $pesv_assesments = PesvAssessment::select(
            'pesv_assessments.id as assessment_id',
            'pesv_assessments.user_id',
            'users.first_name',
            'users.last_name',
            'users.professional_card',
            'clients.identification as client_identification',
            'clients.name as client_name',
            'client_users.headquarters as client_headquarters',
            'client_users.representative as client_representative',
            'pesv_assessments.created_at as fecha_creacion',
            'pesv_assessments.participants',
            'pesv_assessments.key_aspects',
            'work_plans.id as work_plan_id',
            'work_plans.start_date',
            'work_plans.end_date',
            'work_plans.name_president_committee',
            'work_plans.reviewed_by',
            'work_plans.approved_by',
            'work_plans.created_at as date_preparation',
        )->join('users', 'pesv_assessments.user_id', 'users.id')
            ->join('clients', 'pesv_assessments.client_id', 'clients.id')
            ->join('client_users', function ($join) {
                $join->on('pesv_assessments.client_id', '=', 'client_users.client_id')
                    ->on('users.id', '=', 'client_users.user_id');
            })
            ->join('work_plans', 'pesv_assessments.id', 'work_plans.pesv_assessment_id')
            ->find($assessment_id);

        $work_plan = WorkPlanAnswers::select('work_plan_answers.*', 'work_plan_activities.*')
            ->join('work_plan_activities', 'work_plan_answers.work_plan_activity_id', 'work_plan_activities.id')
            ->where('work_plan_answers.work_plan_id', $pesv_assesments->work_plan_id)
            ->orderBy('work_plan_answers.id')
            ->get();


        $cumple = WorkPlanAnswers::where('follow_up', 'CUMPLE')->where('work_plan_id', $pesv_assesments->work_plan_id)->count();
        $parcial = WorkPlanAnswers::where('follow_up', 'CUMPLE PARCIALMENTE')->where('work_plan_id', $pesv_assesments->work_plan_id)->count();
        $noCumple = WorkPlanAnswers::where('follow_up', 'NO CUMPLE')->where('work_plan_id', $pesv_assesments->work_plan_id)->count();
        $total = WorkPlanAnswers::where('work_plan_id', $pesv_assesments->work_plan_id)->count();


        $templatePath = storage_path('app/templates/prosst plantilla plan de trabajo.docx');
        $template = new TemplateProcessor($templatePath);


        $fechaInicio =  Carbon::parse($pesv_assesments->start_date);

        // Generar meses para el cronograma
        for ($i = 0; $i < 12; $i++) {
            $mesFecha = $fechaInicio->copy()->addMonths($i);
            $template->setValue('m' . $i + 1, $mesFecha->isoFormat('MMM'));
        }

        // // Asignar valores simples
        $template->setValue('nit_organizacion', $pesv_assesments['client_identification']);
        $template->setValue('nombre_organizacion', $pesv_assesments['client_name']);
        $template->setValue('fecha_elaboracion', $pesv_assesments['date_preparation']);
        $template->setValue('fecha_inicial', $pesv_assesments['start_date']);
        $template->setValue('fecha_final', $pesv_assesments['end_date']);
        $template->setValue('elabora', $pesv_assesments['first_name'] . ' ' . $pesv_assesments['last_name']);
        $template->setValue('revisor', $pesv_assesments['reviewed_by']);
        $template->setValue('aprobador', $pesv_assesments['approved_by']);
        $template->setValue('nombre_organizacion2', $pesv_assesments['client_name']);
        $template->setValue('fecha_inicial2', $pesv_assesments['start_date']);
        $template->setValue('fecha_final2', $pesv_assesments['end_date']);

        $template->cloneRow('actividades', count($work_plan));
        foreach ($work_plan as $i => $row) {
            $num = $i + 1;
            $template->setValue("actividades#$num", "$row->activity");
            $template->setValue("responsable#$num", "$row->responsible");
            $template->setValue("1#$num", $row->month_1 ? '✔' : '◻');
            $template->setValue("2#$num", $row->month_2 ? '✔' : '◻');
            $template->setValue("3#$num", $row->month_3 ? '✔' : '◻');
            $template->setValue("4#$num", $row->month_4 ? '✔' : '◻');
            $template->setValue("5#$num", $row->month_5 ? '✔' : '◻');
            $template->setValue("6#$num", $row->month_6 ? '✔' : '◻');
            $template->setValue("7#$num", $row->month_7 ? '✔' : '◻');
            $template->setValue("8#$num", $row->month_8 ? '✔' : '◻');
            $template->setValue("9#$num", $row->month_9 ? '✔' : '◻');
            $template->setValue("10#$num", $row->month_10 ? '✔' : '◻');
            $template->setValue("11#$num", $row->month_11 ? '✔' : '◻');
            $template->setValue("12#$num", $row->month_12 ? '✔' : '◻');
            $template->setValue("seguimiento#$num", "$row->follow_up");
            $template->setValue("f#$num", $row->resource_physical ? '✔' : '◻');
            $template->setValue("e#$num", $row->resource_economic ? '✔' : '◻');
            $template->setValue("h#$num", $row->resource_human ? '✔' : '◻');
            $template->setValue("modo_verificacion#$num", "$row->verify_mode");
        }
        $template->setValue('evaluados', ($cumple + $noCumple + $parcial));
        $template->setValue('total_items', $total);
        $template->setValue('porcentaje_avance', ($cumple / $total) * 100);
        $template->setValue('cantidad_no_cumple', $noCumple);
        $template->setValue('porcentaje_no_cumple', ($noCumple / $total) * 100);
        $template->setValue('cantidad_parcial', $parcial);
        $template->setValue('porcentaje_parcial', ($parcial / $total) * 100);
        $template->setValue('cantidad_cumple', $cumple);
        $template->setValue('porcentaje_cumple', ($cumple / $total) * 100);


        $template->setValue('elabora2', $pesv_assesments['first_name'] . ' ' . $pesv_assesments['last_name']);
        $template->setValue('responsable_presidente', $pesv_assesments['reviewed_by']);
        $template->setValue('responsable_aprueba', $pesv_assesments['client_name']);

        // Verificar/Crear directorio temp si no existe
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Ruta completa del archivo temporal
        $filename = 'plan_trabajo_pesv_' . $assessment_id . '_' . time() . '.docx';
        $tempPath = $tempDir . '/' . $filename;

        try {
            // ... (tu lógica de generación del documento)

            // Verificar que el archivo se creó antes de descargar
            $template->saveAs($tempPath);
            if (!file_exists($tempPath)) {
                throw new \Exception("El archivo no se generó correctamente");
            }

            return response()->download($tempPath)
                ->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error generando informe PESV: ' . $e->getMessage());
        }
    }
}
