<?php

namespace App\Http\Controllers;

use App\Models\ImprovementAction;
use App\Models\PesvAssessment;
use App\Models\PesvCauseImprovementPlan;
use App\Models\PesvImprovementPlanAnswer;
use App\Models\StatusAction;
use App\Models\Steps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ImprovementPlanController extends Controller
{
    public function generateImprovementPlan($assessment_id)
    {
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
            ->where('steps.id', '<>', 1)
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

        return true;
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
        //
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
            ->where('pesv_assessments.user_id', Auth::id())
            ->where('states.name', 'Finalizado')
            ->orderBy('pesv_assessments.id', 'desc')
            ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($assessment) {
                $html = '';

                $html = '
                    <a href="' . route('audit.show', $assessment->assessment_id) . '" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="' . route('improvement.answer', $assessment->assessment_id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="' . $assessment->assessment_id . '">
                        <i class="fas fa-trash"></i>
                    </button>
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
            'ARL' => 'ARL (Administradora de Riesgos Laborales)',
            'clientes' => 'Clientes/Usuarios',
            'comite_seguridad' => 'Comité de Seguridad Vial',
            'comunidad' => 'Comunidad',
            'contratistas' => 'Contratistas o subcontratistas',
            'EPS' => 'EPS (Entidad Promotora de Salud)',
            'lider_seguridad' => 'Líder de Seguridad Vial',
            'lideres_proceso' => 'Líderes de Proceso',
            'organismos_control' => 'Organismos de control del Estado',
            'partes_interesadas' => 'Partes interesadas del Proceso',
            'proveedores' => 'Proveedores',
            'representante_legal' => 'Representante Legal',
            'trabajadores' => 'Trabajadores',
            'otro' => 'Otro (especificar)'
        ];
        $canalesDifusion = [
            'cartelera_interna' => 'Anuncio en cartelera interna',
            'boletin_sst' => 'Boletín de SST',
            'campanas_sensibilizacion' => 'Campañas de sensibilización visual',
            'correo_electronico' => 'Correo electrónico',
            'simulacro' => 'Ejercicio de Simulacro o simulación',
            'informe_gestion' => 'Informe de gestión',
            'reuniones_equipo' => 'Informe en reuniones de equipo',
            'leccion_aprendida' => 'Lección aprendida',
            'whatsapp' => 'Mensajes en WhatsApp',
            'apps_corporativas' => 'Notificaciones por apps corporativas',
            'podcasts_videos' => 'Podcasts o videos cortos',
            'intranet' => 'Publicaciones en la intranet',
            'reunion_informativa' => 'Reunión informativa',
            'taller_capacitacion' => 'Taller de capacitación',
            'otro' => 'Otro (especificar)'
        ];

        $statusActions = StatusAction::all();
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

        return view('improvement_plan.answer', compact('assessment_id', 'personasInformar', 'canalesDifusion', 'statusActions', 'improvementActions', 'pesv_cause_improvement_plans', 'preguntas_cero_cumplimiento'));
    }
}
