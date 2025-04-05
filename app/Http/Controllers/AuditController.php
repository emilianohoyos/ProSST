<?php

namespace App\Http\Controllers;

use App\Models\ApplicationLevel;
use App\Models\Client;
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
use Illuminate\Support\Facades\Log;
use Monolog\Level;
use PhpOffice\PhpWord\TemplateProcessor;
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
        $users = Client::where('client_users.user_id', Auth::id())
            ->join('client_users', 'client_users.client_id', 'clients.id')->get();
        // dd($users);
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
            'pesv_assessments.state_id',
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
                $html = '';
                if ($assessment->state_id == 3) {
                    $html = ' <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i> <!-- Icono de tres puntos -->
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Opción 1</a></li>
                    <li><a class="dropdown-item" href="#">Opción 2</a></li>
                    <li><a class="dropdown-item" href="#">Opción 3</a></li>
                </ul>
                </div>';
                } else {
                    $html = '
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
                }


                return $html;
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

        // Calcular si todas las preguntas están respondidas
        $totalPreguntas = $stepsData->sum('total_questions');
        $totalRespondidas = $stepsData->sum('answered_questions');
        $todasRespondidas = ($totalPreguntas > 0) && ($totalPreguntas == $totalRespondidas);

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
            ->with('footer', $todasRespondidas ? '
            <div class="d-grid gap-2 mt-3">
            <button onClick="finalizarAuditoria(' . $assessment_id . ')" 
               class="btn btn-success btn-lg waves-effect waves-light">
                <i class="fas fa-check-circle"></i> Finalizar Auditoría
            </button>
        </div>' : '')
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

    public function finalizeAudit(Request $request)
    {
        $audit = PesvAssessment::find($request->auditoria_id);
        if ($audit) {
            $audit->state_id = 3; // Cambia el estado a finalizada
            $audit->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    function generarInformePESV($auditoria_id)
    {
        $pesv_assesments = PesvAssessment::select(
            'pesv_assessments.id as assessment_id',
            'users.first_name',
            'users.last_name',
            'users.professional_card',
            'clients.identification as client_identification',
            'clients.name as client_name',
            'client_users.headquarters as client_headquarters',
            'client_users.representative as client_representative',
            'application_levels.name_level as application_level',
            'pesv_assessments.created_at as fecha_creacion'
        )
            ->join('users', 'pesv_assessments.user_id', 'users.id')
            ->join('clients', 'pesv_assessments.client_id', 'clients.id')
            ->join('client_users', function ($join) {
                $join->on('pesv_assessments.client_id', '=', 'client_users.client_id')
                    ->on('users.id', '=', 'client_users.user_id');
            })
            ->join('application_levels', 'pesv_assessments.application_level_id', 'application_levels.id')
            ->find($auditoria_id);

        $pasos_resumen = PesvAnswer::select('qualifications.description', DB::raw('count(*) as cantidad'))
            ->join('qualifications', 'pesv_answers.qualification_id', 'qualifications.id')
            ->where('pesv_answers.pesv_assessment_id', $auditoria_id)
            ->groupBy('qualifications.description')
            ->get();

        $desempeno_pasos = Steps::select(
            'steps.id as step_id',
            'steps.description as step_name',
            DB::raw('COUNT(CASE WHEN qualifications.description != \'NO APLICA\' THEN 1 ELSE NULL END) as total_evaluados'),
            DB::raw('SUM(CASE WHEN qualifications.description = \'CUMPLE\' THEN 1 ELSE 0 END) as cumple_count'),
            DB::raw('SUM(CASE WHEN qualifications.description = \'CUMPLE PARCIALMENTE\' THEN 1 ELSE 0 END) as parcial_count'),
            DB::raw('SUM(CASE WHEN qualifications.description = \'NO CUMPLE\' THEN 1 ELSE 0 END) as no_cumple_count'),
            DB::raw('ROUND(
                    (
                        SUM(CASE WHEN qualifications.description = \'CUMPLE\' THEN 1 ELSE 0 END) + 
                        SUM(CASE WHEN qualifications.description = \'CUMPLE PARCIALMENTE\' THEN 1 ELSE 0 END)
                    ) * 100.0 / 
                    NULLIF(COUNT(CASE WHEN qualifications.description != \'NO APLICA\' THEN 1 ELSE NULL END), 0), 
                0
                ) as porcentaje_cumplimiento')
        )
            ->join('pesv_questions', 'pesv_questions.step_id', '=', 'steps.id')
            ->join('pesv_answers', 'pesv_answers.pesv_question_id', '=', 'pesv_questions.id')
            ->join('qualifications', 'pesv_answers.qualification_id', '=', 'qualifications.id')
            ->where('pesv_answers.pesv_assessment_id', $auditoria_id)
            ->groupBy('steps.id', 'steps.description')
            ->orderBy('steps.id')
            ->get();

        $cumplimiento = round($desempeno_pasos->avg('porcentaje_cumplimiento'));

        $this->textoNivelCumplimiento($cumplimiento);
        // Inicializar contadores para cada tipo
        $resumen = [
            'CUMPLE' => 0,
            'CUMPLE PARCIALMENTE' => 0,
            'NO CUMPLE' => 0,
            'NO APLICA' => 0
        ];
        $total_items = 0;
        foreach ($pasos_resumen as $item) {
            $descripcion = strtoupper(trim($item->description));
            if (array_key_exists($descripcion, $resumen)) {
                $resumen[$descripcion] = $item->cantidad;
                $total_items += $item->cantidad;
            }
        }

        // Calcular total y porcentajes
        $total = array_sum($resumen);
        $porcentajes = [];
        foreach ($resumen as $key => $value) {
            $porcentajes[$key] = $total > 0 ? round(($value / $total) * 100, 2) : 0;
        }

        // Preparar datos para la tabla
        $data = [
            ['calificacion' => 'CUMPLE', 'cantidad' => $resumen['CUMPLE'], 'porcentaje' => $porcentajes['CUMPLE']],
            ['calificacion' => 'CUMPLE PARCIALMENTE', 'cantidad' => $resumen['CUMPLE PARCIALMENTE'], 'porcentaje' => $porcentajes['CUMPLE PARCIALMENTE']],
            ['calificacion' => 'NO CUMPLE', 'cantidad' => $resumen['NO CUMPLE'], 'porcentaje' => $porcentajes['NO CUMPLE']],
            ['calificacion' => 'NO APLICA', 'cantidad' => $resumen['NO APLICA'], 'porcentaje' => $porcentajes['NO APLICA']]
        ];

        $templatePath = storage_path('app/templates/prosst plantilla informe.docx');
        $template = new TemplateProcessor($templatePath);

        // Asignar valores simples
        $template->setValue('pesv_assessment', $pesv_assesments['assessment_id']);
        $template->setValue('nit_organizacion', $pesv_assesments['client_identification']);
        $template->setValue('nombre_organizacion', $pesv_assesments['client_name']);
        $template->setValue('fecha_evaluacion', Carbon::now());
        $template->setValue('sede_evaluada', $pesv_assesments['client_headquarters']);
        $template->setValue('representante_legal', $pesv_assesments['client_representative']);
        $template->setValue('evaluador', $pesv_assesments['first_name'] . ' ' . $pesv_assesments['last_name']);
        $template->setValue('participantes', 'carlos hoyos,jose castro');
        $template->setValue('nivel_pesv', $pesv_assesments['application_level']);
        $template->setValue('fecha_informe', $pesv_assesments['fecha_creacion']);

        //hallazgo auditoria
        $template->setValue('texto_cumplimiento', $this->textoNivelCumplimiento($cumplimiento));
        // resumen de cumplimiento
        $template->cloneRow('pasos', count($desempeno_pasos));

        // Asignar valores
        foreach ($desempeno_pasos as $i => $row) {
            $num = $i + 1;
            $template->setValue("pasos#$num", "Paso $row->step_id. $row->step_name.");
            $template->setValue("porcentaje_cumplimiento#$num", $row['porcentaje_cumplimiento']);
        }

        $template->setValue('total_items', $total_items);
        $template->setValue('total_porcentaje_evaluado', 100);

        //desempeño por pasos
        $template->cloneRow('calificacion', count($data));
        foreach ($data as $i => $row) {
            $num = $i + 1;
            $template->setValue("calificacion#$num", $row['calificacion']);
            $template->setValue("cantidad#$num", $row['cantidad']);
            $template->setValue("porcentaje#$num", $row['porcentaje']);
        }


        $template->setValue('cumplimiento_promedio', $cumplimiento);

        // Verificar/Crear directorio temp si no existe
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Ruta completa del archivo temporal
        $filename = 'informe_pesv_' . $auditoria_id . '_' . time() . '.docx';
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

    public function textoNivelCumplimiento($cumplimiento)
    {

        if ($cumplimiento > 0 && $cumplimiento <= 30) {
            return $cumplimiento . '% situándose en la categoría de Muy Bajo. Esto se debe a la implementación o cumplimiento insuficiente de las iniciativas y requisitos establecidos en el Plan Estratégico de Seguridad Vial (PESV), reflejando que solo una mínima parte de estas directrices ha sido efectivamente adoptada o alcanzada.
La organización muestra una adhesión mínima o nula a los requisitos normativos y al PESV. Hay escasa o ninguna evidencia de  acciones implementadas para abordar las causas de accidentes, medidas preventivas, o mejoras en los indicadores de pérdida. La participación de los trabajadores en el PESV es inexistente o insignificante, al igual que la conciencia sobre la seguridad vial y el autocuidado. Las auditorías internas indican una gestión deficiente del riesgo vial, sin integración con el SGSST, y la documentación del PESV es obsoleta o inadecuada.';
        }
        if ($cumplimiento > 30 && $cumplimiento <= 69) {
            return $cumplimiento . '%  lo que la clasifica dentro del nivel de cumplimiento ""Bajo"". La razón de esta clasificación es que, aunque se han adoptado algunas de las medidas y requisitos delineados en el Plan Estratégico de Seguridad Vial (PESV), el nivel de implementación alcanzado hasta ahora no cumple con los requerimientos de la norma y las necesidades del contexto de riesgos de la organización. 
La organización ha comenzado a implementar algunos elementos del PESV, pero el grado de cumplimiento sigue siendo insuficiente. Existen acciones limitadas para abordar las principales causas de accidentes y las medidas preventivas son esporádicas. La mejora en los indicadores de pérdida es marginal. La participación de los trabajadores y la conciencia sobre seguridad vial necesitan fortalecerse significativamente. Las auditorías muestran poco avance y la integración con el SGSST es débil. La documentación del PESV requiere actualizaciones significativas.';
        }
        if ($cumplimiento > 69 && $cumplimiento <= 80) {
            return $cumplimiento . '% ubicándose en la categoría de cumplimiento ""Moderado"". Esto se atribuye a que se ha logrado implementar satisfactoriamente un número moderado de las iniciativas y requisitos contemplados en el Plan Estratégico de Seguridad Vial (PESV), sin embargo aún presenta aspectos claves que no ha implementado.

La organización ha implementado un número moderado de iniciativas y requisitos del PESV satisfactoriamente. Se evidencian esfuerzos por abordar las causas de accidentes y se priorizan las medidas preventivas con una mejora observable en los indicadores de pérdida. La participación de los trabajadores y la conciencia sobre seguridad vial están presentes, pero con margen de mejora. Las auditorías reflejan avances moderados en la gestión del riesgo vial y una integración parcial con el SGSST. La documentación del PESV está mayormente actualizada.';
        }
        if ($cumplimiento > 80 && $cumplimiento <= 94) {
            return $cumplimiento . '% clasificándose en el nivel ""Alto"" de cumplimiento. Este resultado se debe a que la mayoría de las iniciativas y requisitos establecidos en el Plan Estratégico de Seguridad Vial (PESV) han sido implementados de forma efectiva.

La mayoría de las iniciativas y requisitos del PESV se han implementado efectivamente. La organización muestra un compromiso claro con la seguridad vial, con medidas preventivas bien establecidas y una mejora significativa en los indicadores de pérdida. Hay una participación activa de los trabajadores en el PESV y una alta conciencia sobre seguridad vial. Las auditorías internas indican una buena gestión del riesgo vial y una integración sólida con el SGSST. La documentación del PESV es actual y completa.';
        }
        if ($cumplimiento > 94 && $cumplimiento <= 100) {
            return $cumplimiento . '% clasificándose en el nivel ""Muy alto"" de cumplimiento. Este resultado se debe a que la mayoría de las iniciativas y requisitos establecidos en el Plan Estratégico de Seguridad Vial (PESV) han sido implementados de forma efectiva y dando cumplimiento a la normatividad vigente.

La organización exhibe un cumplimiento ejemplar de los requisitos normativos y del PESV. Todas o casi todas las iniciativas han sido implementadas con éxito, mostrando una mejora sustancial en los indicadores de pérdida y una cultura de seguridad vial profundamente arraigada. La participación de los trabajadores y contratistas es excelente, y las estrategias de conciencia sobre seguridad vial están plenamente integradas. Las auditorías reflejan una gestión del riesgo vial excepcional, con una integración total con el SGSST. La documentación del PESV es ejemplar, estando completamente actualizada y revisada regularmente.';
        }
    }
}
