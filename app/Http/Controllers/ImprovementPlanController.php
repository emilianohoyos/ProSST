<?php

namespace App\Http\Controllers;

use App\Models\ActionType;
use App\Models\ImprovementAction;
use App\Models\PesvAssessment;
use App\Models\PesvCauseImprovementPlan;
use App\Models\PesvImprovementPlanAnswer;
use App\Models\StatusAction;
use App\Models\Steps;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;
use Yajra\DataTables\Facades\DataTables;

class ImprovementPlanController extends Controller
{
    public function generateImprovementPlan($assessment_id)
    {
        $exists = PesvImprovementPlanAnswer::where('pesv_assessment_id', $assessment_id)->exists();

        if ($exists) {
            return to_route('improvement-plan.index');;
        }

        $preguntas_cero_cumplimiento = Steps::select(
            // 'steps.id as step_id',
            // 'steps.description as step_name',
            'pesv_questions.id as question_id',
            // 'pesv_questions.question',
            'pesv_questions.desc_detected_situation',
            'qualifications.description as respuesta',
        )
            ->join('pesv_questions', 'pesv_questions.step_id', '=', 'steps.id')
            ->join('pesv_answers', 'pesv_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('qualifications', 'pesv_answers.qualification_id', '=', 'qualifications.id')
            ->where('pesv_answers.pesv_assessment_id', $assessment_id)
            ->where('qualifications.description', 'NO CUMPLE')
            ->where('steps.id', '<>', 0)
            ->orderBy('steps.id')
            ->orderBy('pesv_questions.id')
            ->get();



        foreach ($preguntas_cero_cumplimiento as $pregunta) {
            PesvImprovementPlanAnswer::create([
                'pesv_assessment_id' => $assessment_id,
                'pesv_question_id' =>  $pregunta->question_id,
                'user_id' => Auth::id(),
                'action_type_id' => 1,
                'execution_date' => Carbon::now()
            ]);
        }

        return to_route('improvement-plan.index');
    }


    public function index()
    {
        return view('improvement_plan.index');
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
    public function edit(string $id)
    {
        $preguntas_cero_cumplimiento = PesvImprovementPlanAnswer::select(
            'pesv_improvement_plan_answers.id',
            'pesv_improvement_plan_answers.execution_date',
            'action_types.name as action_type',
            'action_types.id as action_type_id',
            'pesv_questions.desc_detected_situation',
            'pesv_cause_improvement_plans.id as pesv_cause_improvement_plan_id',
            'pesv_cause_improvement_plans.name as pesv_cause_improvement_plan',
            'pesv_questions.improvement_action',
            'improvement_actions.id as improvement_action_id',
            'improvement_actions.name as improvement_action_efficent',
            'status_actions.id as status_action_id',
            'status_actions.name as status_action',
            'pesv_improvement_plan_answers.people_to_be_informed',
            'pesv_improvement_plan_answers.channel_diffusion_improvement_action',
            'pesv_improvement_plan_answers.observation',


        )
            ->join('pesv_questions', 'pesv_improvement_plan_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('action_types', 'pesv_improvement_plan_answers.action_type_id', '=', 'action_types.id')
            ->leftJoin('pesv_cause_improvement_plans', 'pesv_improvement_plan_answers.pesv_cause_improvement_plan_id', '=', 'pesv_cause_improvement_plans.id')
            ->leftJoin('improvement_actions', 'pesv_improvement_plan_answers.improvement_action_id', '=', 'improvement_actions.id')
            ->leftJoin('status_actions', 'pesv_improvement_plan_answers.status_action_id', '=', 'status_actions.id')

            ->where('pesv_improvement_plan_answers.id', $id)
            ->orderBy('pesv_improvement_plan_answers.id')
            ->get();

        if ($preguntas_cero_cumplimiento->isEmpty()) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $preguntas_cero_cumplimiento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $id);
        $plan = PesvImprovementPlanAnswer::find($id);
        $plan->execution_date = $request->execution_date;
        $plan->action_type_id = $request->action_type_id;
        $plan->pesv_cause_improvement_plan_id = $request->pesv_cause_improvement_plan_id;
        $plan->improvement_action_id = $request->improvement_action_id;
        $plan->status_action_id = $request->status_action_id;
        $plan->people_to_be_informed = $request->people_to_be_informed;
        $plan->channel_diffusion_improvement_action = $request->channel_diffusion_improvement_action;
        $plan->observation = $request->observation;
        $plan->save();

        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function datatableImprovement()
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
            ->rightJoin('pesv_improvement_plan_answers', 'pesv_assessments.id', '=', 'pesv_improvement_plan_answers.pesv_assessment_id')
            ->where('pesv_assessments.user_id', Auth::id())
            ->where('states.name', 'Finalizado')
            ->groupBy([
                'pesv_assessments.id',
                'pesv_assessments.assessment_type_id',
                'pesv_assessments.state_id',
                'pesv_assessments.completed_at',
                'clients.name',
                'application_levels.name_level',
                'states.name',
                'assessment_types.name'
            ])
            ->orderBy('pesv_assessments.id', 'desc')
            ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($assessment) {
                $html = '';

                $html = '

              
                    <a href="' . route('improvement.answer', $assessment->assessment_id) . '" class="btn btn-sm btn-warning" title="Diligenciar Plan de trabajo">
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
        $personasInformar = [
            ['name' => 'ARL (Administradora de Riesgos Laborales)'],
            ['name' => 'Clientes/Usuarios'],
            ['name' => 'Comité de Seguridad Vial'],
            ['name' => 'Comunidad'],
            ['name' => 'Contratistas o subcontratistas'],
            ['name' => 'EPS (Entidad Promotora de Salud)'],
            ['name' => 'Líder de Seguridad Vial'],
            ['name' => 'Líderes de Proceso'],
            ['name' => 'Organismos de control del Estado'],
            ['name' => 'Partes interesadas del Proceso'],
            ['name' => 'Proveedores'],
            ['name' => 'Representante Legal'],
            ['name' => 'Trabajadores'],
            ['name' => 'Otro (especificar)']
        ];
        $canalesDifusion = [
            ['name' => 'Anuncio en cartelera interna'],
            ['name' => 'Boletín de SST'],
            ['name' => 'Campañas de sensibilización visual'],
            ['name' => 'Correo electrónico'],
            ['name' => 'Ejercicio de Simulacro o simulación'],
            ['name' => 'Informe de gestión'],
            ['name' => 'Informe en reuniones de equipo'],
            ['name' => 'Lección aprendida'],
            ['name' => 'Mensajes en WhatsApp'],
            ['name' => 'Notificaciones por apps corporativas'],
            ['name' => 'Podcasts o videos cortos'],
            ['name' => 'Publicaciones en la intranet'],
            ['name' => 'Reunión informativa'],
            ['name' => 'Taller de capacitación'],
            ['name' => 'Otro (especificar)']
        ];


        $statusActions = StatusAction::all();
        $action_types = ActionType::all();
        $improvementActions = ImprovementAction::all();
        $pesv_cause_improvement_plans = PesvCauseImprovementPlan::all();
        $preguntas_cero_cumplimiento = PesvImprovementPlanAnswer::select(
            'pesv_improvement_plan_answers.id',
            'pesv_improvement_plan_answers.execution_date',
            'action_types.name as action_type',
            'pesv_questions.desc_detected_situation',
            'pesv_cause_improvement_plans.id as pesv_cause_improvement_plan_id',
            'pesv_cause_improvement_plans.name as pesv_cause_improvement_plan',
            'pesv_questions.improvement_action',
            'improvement_actions.id as improvement_action_id',
            'improvement_actions.name as improvement_action_efficent',
            'status_actions.id as status_action_id',
            'status_actions.name as status_action',
            'pesv_improvement_plan_answers.people_to_be_informed',
            'pesv_improvement_plan_answers.channel_diffusion_improvement_action',

        )
            ->join('pesv_questions', 'pesv_improvement_plan_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('action_types', 'pesv_improvement_plan_answers.action_type_id', '=', 'action_types.id')
            ->leftJoin('pesv_cause_improvement_plans', 'pesv_improvement_plan_answers.pesv_cause_improvement_plan_id', '=', 'pesv_cause_improvement_plans.id')
            ->leftJoin('improvement_actions', 'pesv_improvement_plan_answers.improvement_action_id', '=', 'improvement_actions.id')
            ->leftJoin('status_actions', 'pesv_improvement_plan_answers.status_action_id', '=', 'status_actions.id')

            ->where('pesv_improvement_plan_answers.pesv_assessment_id', $assessment_id)
            ->get();


        // dd($preguntas_cero_cumplimiento);

        return view('improvement_plan.answer', compact('assessment_id', 'action_types', 'personasInformar', 'canalesDifusion', 'statusActions', 'improvementActions', 'pesv_cause_improvement_plans', 'preguntas_cero_cumplimiento'));
    }

    public function datatableImprovementDetails($assessment_id)
    {
        $preguntas_cero_cumplimiento = PesvImprovementPlanAnswer::select(
            'pesv_improvement_plan_answers.id',
            'pesv_improvement_plan_answers.execution_date',
            'action_types.name as action_type',
            'pesv_questions.desc_detected_situation',
            'pesv_cause_improvement_plans.id as pesv_cause_improvement_plan_id',
            'pesv_cause_improvement_plans.name as pesv_cause_improvement_plan',
            'pesv_questions.improvement_action',
            'improvement_actions.id as improvement_action_id',
            'improvement_actions.name as improvement_action_efficent',
            'status_actions.id as status_action_id',
            'status_actions.name as status_action',
            'pesv_improvement_plan_answers.people_to_be_informed',
            'pesv_improvement_plan_answers.channel_diffusion_improvement_action',
            'pesv_improvement_plan_answers.observation',


        )
            ->join('pesv_questions', 'pesv_improvement_plan_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('action_types', 'pesv_improvement_plan_answers.action_type_id', '=', 'action_types.id')
            ->leftJoin('pesv_cause_improvement_plans', 'pesv_improvement_plan_answers.pesv_cause_improvement_plan_id', '=', 'pesv_cause_improvement_plans.id')
            ->leftJoin('improvement_actions', 'pesv_improvement_plan_answers.improvement_action_id', '=', 'improvement_actions.id')
            ->leftJoin('status_actions', 'pesv_improvement_plan_answers.status_action_id', '=', 'status_actions.id')

            ->where('pesv_improvement_plan_answers.pesv_assessment_id', $assessment_id)
            ->orderBy('pesv_improvement_plan_answers.id', 'asc')
            ->get();

        return DataTables::of($preguntas_cero_cumplimiento)
            ->addColumn('action', function ($assessment) {
                $html = '';

                $html = '
                    <button class="btn btn-sm btn-warning" onclick="updateInfo(' . $assessment->id . ')"><i class="fas fa-pen"></i></button>
                ';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function generateWordImprovementPlan($assessment_id)
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
            'application_levels.name_level as application_level',
            'pesv_assessments.created_at as fecha_creacion',
            'pesv_assessments.participants',
            'pesv_assessments.key_aspects',

        )
            ->join('users', 'pesv_assessments.user_id', 'users.id')
            ->join('clients', 'pesv_assessments.client_id', 'clients.id')
            ->join('client_users', function ($join) {
                $join->on('pesv_assessments.client_id', '=', 'client_users.client_id')
                    ->on('users.id', '=', 'client_users.user_id');
            })
            ->join('application_levels', 'pesv_assessments.application_level_id', 'application_levels.id')
            ->find($assessment_id);

        $items_improvement_plan = PesvImprovementPlanAnswer::select(
            'pesv_improvement_plan_answers.id',
            'pesv_improvement_plan_answers.execution_date',
            'action_types.name as action_type',
            'pesv_questions.desc_detected_situation',
            'pesv_cause_improvement_plans.id as pesv_cause_improvement_plan_id',
            'pesv_cause_improvement_plans.name as pesv_cause_improvement_plan',
            'pesv_questions.improvement_action',
            'improvement_actions.id as improvement_action_id',
            'improvement_actions.name as improvement_action_efficent',
            'status_actions.id as status_action_id',
            'status_actions.name as status_action',
            'pesv_improvement_plan_answers.people_to_be_informed',
            'pesv_improvement_plan_answers.channel_diffusion_improvement_action',
            'pesv_improvement_plan_answers.observation',
        )
            ->join('pesv_questions', 'pesv_improvement_plan_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('action_types', 'pesv_improvement_plan_answers.action_type_id', '=', 'action_types.id')
            ->leftJoin('pesv_cause_improvement_plans', 'pesv_improvement_plan_answers.pesv_cause_improvement_plan_id', '=', 'pesv_cause_improvement_plans.id')
            ->leftJoin('improvement_actions', 'pesv_improvement_plan_answers.improvement_action_id', '=', 'improvement_actions.id')
            ->leftJoin('status_actions', 'pesv_improvement_plan_answers.status_action_id', '=', 'status_actions.id')
            ->where('pesv_improvement_plan_answers.pesv_assessment_id', $assessment_id)
            ->orderBy('pesv_improvement_plan_answers.id', 'asc')
            ->get();

        $firma_evaluador = User::find($pesv_assesments->user_id);
        $signPath = $firma_evaluador->sign_path; // Ejemplo: 'storage/firmas/firma_juan_perez.png'
        // Verifica que el archivo exista
        if (!file_exists(storage_path('app/public/' . $signPath))) {
            throw new \Exception("El archivo de firma no existe en: " . $signPath);
        }
        $templatePath = storage_path('app/templates/prosst plantilla plan de mejora.docx');
        $template = new TemplateProcessor($templatePath);

        // Asignar valores simples
        $template->setValue('nit_organizacion', $pesv_assesments['client_identification']);
        $template->setValue('nombre_organizacion', $pesv_assesments['client_name']);
        $template->setValue('fecha_evaluacion', Carbon::now());
        $template->setValue('sede_evaluada', $pesv_assesments['client_headquarters']);
        $template->setValue('representante_legal', $pesv_assesments['client_representative']);
        $template->setValue('evaluador', $pesv_assesments['first_name'] . ' ' . $pesv_assesments['last_name']);
        $template->setValue('participantes',  $pesv_assesments['participants']);
        $template->setValue('nivel_pesv', $pesv_assesments['application_level']);
        $template->setValue('fecha_informe', $pesv_assesments['fecha_creacion']);

        $template->cloneRow('fecha', count($items_improvement_plan));
        foreach ($items_improvement_plan as $i => $row) {
            $num = $i + 1;
            $template->setValue("fecha#$num", "$row->execution_date");
            $template->setValue("tipo_accion#$num", $row->action_type);
            $template->setValue("desc_situacion#$num", $row->desc_detected_situation);
            $template->setValue("analisis_de_causa#$num", $row->pesv_cause_improvement_plan);
            $template->setValue("accion_mejora#$num", $row->improvement_action);
            $template->setValue("mejora_eficaz#$num", $row->improvement_action_efficent);
            $template->setValue("estado#$num", $row->status_action);

            if (is_array($row->people_to_be_informed)) {
                $personas = implode(', ', $row->people_to_be_informed);
                $template->setValue("personas#$num", $personas);
            } else {
                // Manejar el caso en que no es un array
                $template->setValue("personas#$num", $row->people_to_be_informed);
            }

            if (is_array($row->channel_diffusion_improvement_action)) {
                $personas = implode(', ', $row->channel_diffusion_improvement_action);
                $template->setValue("mecanismos#$num", $personas);
            } else {
                // Manejar el caso en que no es un array
                $template->setValue("mecanismos#$num", $row->channel_diffusion_improvement_action);
            }

            $template->setValue("observacion#$num", $row->observation);
        }

        // Agregar la imagen de la firma
        $template->setImageValue('firma_evaluador', [
            'path' => storage_path('app/public/' . $signPath),
            'width' => 100, // Ancho en puntos (1 cm ≈ 28.35 puntos)
            'height' => 50,  // Alto en puntos
            'ratio' => false // Mantener dimensiones exactas
        ]);

        // Verificar/Crear directorio temp si no existe
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Ruta completa del archivo temporal
        $filename = 'plan_mejora_pesv_' . $assessment_id . '_' . time() . '.docx';
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
