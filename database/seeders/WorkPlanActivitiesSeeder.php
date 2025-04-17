<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkPlanActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'activity' => 'Designar una persona para liderar el diseño e implementación del PESV y articularlo con el SG-SST.',
                'application_level' => 'AVANZADO, INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección',
                'verify_mode' => 'Acta de nombramiento'
            ],
            [
                'activity' => 'Conformar un Comité de Seguridad Vial con al menos tres miembros designados por el nivel directivo.',
                'application_level' => 'AVANZADO, INTERMEDIO',
                'responsible' => 'Alta dirección',
                'verify_mode' => 'Acta de conformación'
            ],
            [
                'activity' => 'Designar al líder del diseño e implementación del Plan Estratégico de Seguridad Vial (PESV) como parte del Comité.',
                'application_level' => 'AVANZADO,INTERMEDIO',
                'responsible' => 'Alta dirección',
                'verify_mode' => 'Acta de designación'
            ],
            [
                'activity' => 'Realizar informes trimestrales de seguimiento del PESV, evaluando el progreso y ajustando el plan según sea necesario.',
                'application_level' => 'AVANZADO, INTERMEDIO',
                'responsible' => 'comité de seguridad vial',
                'verify_mode' => 'Informes trimestrales'
            ],
            [
                'activity' => 'Desarrollar un programa de capacitaciones para el Comité y empleados relevantes, y evaluar proveedores de servicios vehiculares para mantener la seguridad de la flota.',
                'application_level' => 'AVANZADO, INTERMEDIO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de diseño e implementación del programa'
            ],
            [
                'activity' => 'Desarrollar y documentar una Política de Seguridad Vial que abarque los desplazamientos laborales y los trayectos en itinere para todos los colaboradores de la organización.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección, Lider del Pesv',
                'verify_mode' => 'Politica documentada'
            ],
            [
                'activity' => 'Realizar revisión periódica de la Política de seguridad vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección, Lider del Pesv y Comité vial',
                'verify_mode' => 'Acta la realización'
            ],
            [
                'activity' => 'Asegurar el suministro de recursos financieros, técnicos y humanos destinados al PESV por parte de la alta dirección.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección',
                'verify_mode' => 'Evidencias del suministro de recursos'
            ],
            [
                'activity' => 'Asegurar que los vehículos, equipos, repuestos y servicios contratados en el mantenimiento de los vehículos cumplen con las especificaciones de seguridad según la normatividad vigente.',
                'application_level' => 'AVANZADO, INTERMEDIO',
                'responsible' => 'Alta dirección, Lider del Pesv',
                'verify_mode' => 'Evidencias de mantenimiento'
            ],
            [
                'activity' => 'Garantizar la participación activa de la alta dirección en al menos una reunión del comité de seguridad vial anualmente para revisar los resultados del PESV.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección',
                'verify_mode' => 'Acta de la reunión'
            ],
            [
                'activity' => 'Definir una línea base para identificar los problemas de seguridad vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Linea basal realizada'
            ],
            [
                'activity' => 'Detallar una lista de colaboradores y contratistas con la información requerida, incluyendo datos personales, licencia de conducción, capacitaciones, infracciones de tránsito, entre otros.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Caracterización de conductores'
            ],
            [
                'activity' => 'Proporcionar una lista de vehículos (automotores y no automotores) con las especificaciones técnicas y mantenimientos requeridos.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Listado de vehiculos identificados'
            ],
            [
                'activity' => 'Elaborar una lista de rutas frecuentes de los desplazamientos laborales con la información necesaria.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Listado de rutas identificadas'
            ],
            [
                'activity' => 'Actualizar el diagnóstico del PESV al menos una vez al año para reflejar los cambios y la evolución de los aspectos relacionados con la seguridad vial en la organización.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección, Lider del Pesv y Comité vial',
                'verify_mode' => 'Diagnostico del PESV actualizado.'
            ],
            [
                'activity' => 'Actualizar la herramienta para la identificación, evaluación y control de los riesgos en seguridad vial como mínimo una vez al año y/o cada vez que ocurra un siniestro vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Herramienta definida'
            ],
            [
                'activity' => 'Realizar la identificación de riesgos en seguridad vial abarcando todos los actores viales implicados.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Matriz de riesgos actualizada'
            ],
            [
                'activity' => 'Implementar controles de seguridad para prevenir los riesgos de seguridad vial identificados.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evidencia de los controles implementados'
            ],
            [
                'activity' => 'Definir los objetivos y metas del PESV.',
                'application_level' => 'AVANZADO, INTERMEDIO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'objetivos y metas definidos'
            ],
            [
                'activity' => 'Comunicar los objetivos y metas del PESV a todos los colaboradores.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider del Pesv y Comité vial',
                'verify_mode' => 'Evidencias de la comunicación'
            ],
            // Continúa con el resto de actividades...
            [
                'activity' => 'Actualizar, revisar y evaluar los objetivos y metas del PESV mínimo una vez al año.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección, Lider del Pesv y Comité vial',
                'verify_mode' => 'Acta de actualización'
            ],
            [
                'activity' => 'Diseñar y documentar los programas mínimos requeridos: Gestión de la Velocidad Segura, Prevención de la Fatiga, Prevención de la Distracción, Cero Tolerancia a la conducción bajo los efectos del alcohol y de sustancias psicoactivas, y Protección de Actores Viales Vulnerables.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Programas diseñados y documentados.'
            ],
            [
                'activity' => 'Implementar los programas de gestión del riesgo critico',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evidencias de la implementación de los'
            ],
            [
                'activity' => 'Actualizar los programas al menos una vez al año.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Acta de actualización'
            ],
            [
                'activity' => 'Divulgar los programas a todos los colaboradores de la Organización.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Acta de divulgación'
            ],
            [
                'activity' => 'Documentar el plan anual del PESV con los objetivos, metas, responsabilidades, recursos y cronograma de actividades del año.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Plan anual documentado'
            ],
            [
                'activity' => 'Definir y documentar la competencia (educación, formación y experiencia) en seguridad vial para los roles especificados.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Manual de competencias documentado'
            ],
            [
                'activity' => 'Evaluar la competencia y actualización de los capacitadores de seguridad vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Resultados de la evaluación realizada'
            ],
            [
                'activity' => 'Promover la formación de hábitos, comportamientos y conductas seguras en la vía entre todos los colaboradores.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Alta dirección, Lider del Pesv y Comité vial',
                'verify_mode' => 'Evidencias de la promoción'
            ],
            [
                'activity' => 'Implementar un plan anual de formación en seguridad vial, incluyendo temas específicos para cada actor vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la implementación'
            ],
            [
                'activity' => 'Evaluar la eficacia de la formación en seguridad vial y documentar evidencia de esta evaluación.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la evaluación'
            ],
            [
                'activity' => 'Implementar medidas para mejorar la eficacia de la formación en seguridad vial basadas en evaluaciones previas.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de controles implementados'
            ],
            [
                'activity' => 'Asignar, documentar y comunicar las funciones y responsabilidades en seguridad vial a todos los actores viales de la organización.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Alta dirección, Lider del Pesv',
                'verify_mode' => 'Documentación de funciones y responsabilidades'
            ],
            [
                'activity' => 'Realizar la evaluación de la competencia en seguridad vial a colaboradores que realizan desplazamientos laborales, al menos una vez al año.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la evaluación'
            ],
            [
                'activity' => 'Establecer y documentar el procedimiento de requisitos de contratación en seguridad vial para colaboradores que realizan desplazamientos laborales.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Documentar el procedimiento de evaluación de la competencia de los conductores.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Definir la metodología para lograr comportamientos interdependientes y promover la formación de hábitos y conductas seguros en la vía.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Metodologia definida por escrito'
            ],
            [
                'activity' => 'Implementar programas de motivación y campañas para promover la seguridad vial.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la implementación'
            ],
            [
                'activity' => 'Elaborar e implementar un plan de preparación y respuesta ante emergencias viales, incluyendo reporte de siniestros viales y la cadena de llamado.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la implementación'
            ],
            [
                'activity' => 'Realizar un simulacro anual sobre siniestros viales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la implementación'
            ],
            [
                'activity' => 'Asegurar que la cadena de llamadas y el reporte de siniestros viales funcionen adecuadamente.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Verificaciones realizadas'
            ],
            [
                'activity' => 'Proporcionar capacitación a brigadistas viales o primeros respondientes en protocolos de atención a víctimas de siniestros viales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de las capacitaciones'
            ],
            [
                'activity' => 'Documentar la técnica, metodología o procedimiento implementado para reportar, registrar, investigar, analizar y divulgar los siniestros viales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Asegurar que todos los tipos de siniestros viales involucrando a colaboradores sean reportados y registrados adecuadamente.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Registro de los siniestros reportados'
            ],
            [
                'activity' => 'Divulgar las lecciones aprendidas de los siniestros viales.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la divulgación'
            ],
            [
                'activity' => 'Implementar planes de mejora basados en hallazgos de investigaciones de siniestros viales.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evidencias de la implementación'
            ],
            [
                'activity' => 'Evaluar la eficacia de las acciones correctivas implementadas para mitigar riesgos identificados.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evidencias de la evaluación'
            ],
            [
                'activity' => 'Documentar un protocolo de operación y mantenimiento de las vías públicas y/o privadas que administra la organización.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Protocolo documentado'
            ],
            [
                'activity' => 'Documentar la identificación de zonas de conflicto de tránsito y ejecutar planes de acción correspondientes, incluyendo inspecciones anuales y mantenimiento preventivo de la infraestructura vial.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Documentación relacionada'
            ],
            [
                'activity' => 'Realizar inspecciones de seguridad vial en puntos críticos de mayor siniestralidad.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencia de las inspecciones'
            ],
            [
                'activity' => 'Documentar el procedimiento de planificación de viajes misionales de colaboradores, considerando riesgos relacionados con la seguridad vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Planificar el ingreso y salida del personal de las instalaciones de la organización.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la planificación'
            ],
            [
                'activity' => 'Definir claramente horarios y tiempos de conducción, así como velocidades seguras recomendadas durante los desplazamientos laborales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Documento con la información requerida'
            ],
            [
                'activity' => 'Asegurar el cumplimiento de la documentación requerida por los colaboradores durante los desplazamientos.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias del cumplimiento'
            ],
            [
                'activity' => 'Realizar controles durante el recorrido para prevenir factores de riesgo como fatiga, velocidad y distracción del conductor.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de los controles'
            ],
            [
                'activity' => 'Ofrecer capacitación en identificación y análisis dinámico de riesgos en las vías para desplazamientos laborales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de las capacitaciones'
            ],
            [
                'activity' => 'Definir un procedimiento para la inspección preoperacional diaria de vehículos utilizados en desplazamientos laborales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Asegurar que las inspecciones se realicen diariamente y de manera adecuada.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencia de las inspecciones'
            ],
            [
                'activity' => 'Actuar sobre mejoras identificadas a partir de los hallazgos de estas inspecciones.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evidencia de las mejoras implementadas'
            ],
            [
                'activity' => 'Proporcionar capacitación regular a responsables de realizar y controlar las inspecciones.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencia de las capacitaciones'
            ],
            [
                'activity' => 'Diseñar e implementar un plan de mantenimiento preventivo para vehículos utilizados en desplazamientos laborales.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias del Plan de mantenimiento implementado'
            ],
            [
                'activity' => 'Documentar y mantener actualizada la hoja de vida de cada vehículo utilizado para desplazamientos laborales, incluyendo historial de adquisición, mantenimientos y reparaciones.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Hoja de vida de todos los vehiculos'
            ],
            [
                'activity' => 'Evaluar la efectividad del plan de mantenimiento preventivo e identificar áreas de mejora para garantizar la seguridad de los vehículos y sus ocupantes.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección',
                'verify_mode' => 'Evaluaciones al plan de mantenimiento realizadas'
            ],
            [
                'activity' => 'Proporcionar formación específica sobre mantenimiento vehicular seguro a colaboradores que usan su propio vehículo para desplazamientos laborales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la formación realizada'
            ],
            [
                'activity' => 'Evaluar los cambios externos e internos que afectan la seguridad vial y documentar la evidencia de esta evaluación.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV, Alta dirección, Comité Vial',
                'verify_mode' => 'Evidencia de la evaluación'
            ],
            [
                'activity' => 'Comunicar a contratistas, subcontratistas y terceros los requisitos de seguridad vial que deben cumplir.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de las comunicaciones'
            ],
            [
                'activity' => 'Verificar anualmente o antes de cada recorrido la documentación vigente de conductores y vehículos de contratistas, incluyendo SOAT, revisión técnico-mecánica, y otros documentos relevantes.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Verificaciones realizadas'
            ],
            [
                'activity' => 'Recopilar y mantener información sobre el historial del conductor y del vehículo de contratistas, incluyendo infracciones de tránsito y mantenimientos.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Historial de cada conductor'
            ],
            [
                'activity' => 'Implementar un mecanismo para que contratistas reporten siniestros viales y condiciones de salud que afecten la conducción.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Reportes de los siniestros'
            ],
            [
                'activity' => 'Establecer un procedimiento para la organización, disponibilidad, control y actualización de la documentación del Plan Estratégico de Seguridad Vial.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Procedimiento documentado'
            ],
            [
                'activity' => 'Realizar revisiones periódicas de la documentación y registros del PESV para asegurar su relevancia y exactitud.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencia de revisiones realizadas'
            ],
            [
                'activity' => 'Registrar, medir y analizar los indicadores mínimos de gestión del PESV.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección, Comité Vial',
                'verify_mode' => 'Indicadores registrados, medidos y analizados'
            ],
            [
                'activity' => 'Realizar el reporte de autogestión anual a la entidad verificadora correspondiente con los resultados de la medición y análisis de los indicadores al 31 de diciembre de cada año.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias del reporte anual'
            ],
            [
                'activity' => 'Presentar un informe semestral de resultados de los indicadores a la alta dirección sobre el PESV.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Comité Vial',
                'verify_mode' => 'Informes trimestrales'
            ],
            [
                'activity' => 'Implementar acciones de mejora cuando los indicadores del PESV no alcanzan el cumplimiento esperado.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV, Alta dirección, Comité Vial',
                'verify_mode' => 'Acciones implementadas'
            ],
            [
                'activity' => 'Llevar un registro estadístico, analizar la tendencia y proyección de los siniestros viales, diferenciando según la gravedad y separando los análisis de desplazamientos laborales de los no laborales.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Registro de los siniestros reportados'
            ],
            [
                'activity' => 'El Comité de Seguridad Vial debe analizar los resultados de la siniestralidad vial.',
                'application_level' => 'AVANZADO',
                'responsible' => 'Comité Vial',
                'verify_mode' => 'Acta del comité'
            ],
            [
                'activity' => 'Realizar al menos una auditoría interna anual enfocada en el PESV y documentar las mejoras implementadas a partir de los resultados.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Auditor externo al proceso',
                'verify_mode' => 'Informe de auditoría'
            ],
            [
                'activity' => 'Formar a los auditores internos o verificar su competencia en seguridad vial.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV',
                'verify_mode' => 'Evidencias de la formación realizada'
            ],
            [
                'activity' => 'Definir e implementar acciones preventivas y/o correctivas basadas en los resultados de la medición y análisis de los indicadores y auditorías del PESV.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Alta dirección, Comité Vial',
                'verify_mode' => 'Acciones implementadas'
            ],
            [
                'activity' => 'Asegurar que las políticas y actividades de seguridad vial sean comunicadas efectivamente a todos los niveles de la organización.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Comité Vial',
                'verify_mode' => 'Comunicaciones realizadas'
            ],
            [
                'activity' => 'Realizar comunicaciones trimestrales con los trabajadores sobre promoción de la seguridad vial, indicadores, resultados del PESV, y los riesgos y controles para prevenir siniestros viales.',
                'application_level' => 'AVANZADO,INTERMEDIO, BASICO',
                'responsible' => 'Lider PESV, Comité Vial',
                'verify_mode' => 'Comunicaciones realizadas'
            ]
        ];

        // Insertar los datos en la tabla
        DB::table('work_plan_activities')->insert($activities);
    }
}
