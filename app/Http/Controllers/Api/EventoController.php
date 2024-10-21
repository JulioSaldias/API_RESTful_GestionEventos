<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="gestioneventos", version="1.0.0")
 * @OA\Server(url="http://localhost:8000")
 */

/**
 * @OA\Schema(
 *     schema="Evento",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nombre_evento", type="string"),
 *     @OA\Property(property="descripcion", type="string"),
 *     @OA\Property(property="tipo_evento", type="string"),
 *     @OA\Property(property="fecha_conclusion", type="string", format="date")
 * )
 */

/**
 * 
 * 
 * 
 * @OA\Tag(
 *     name="Eventos",
 *     description="Operaciones relacionadas con los eventos"
 * )
 */


/**
 * @OA\Get(
 *     path="/api/Eventos",
 *     summary="Listar todos los eventos",
 *     description="Obtener una lista de todos los eventos. Se puede aplicar un filtro por tipo de evento.",
 *     operationId="getEventos",
 *     tags={"Eventos"},
 *     @OA\Parameter(
 *         name="tipo_evento",
 *         in="query",
 *         required=false,
 *         description="Filtrar eventos por tipo",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de eventos obtenida exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Eventos", type="array", @OA\Items(ref="#/components/schemas/Evento")),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró ningún evento con ese tipo.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/Eventos",
 *     summary="Crear un nuevo evento",
 *     description="Registrar un nuevo evento en el sistema.",
 *     operationId="createEvento",
 *     tags={"Eventos"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_evento", type="string", example="Concierto de Rock"),
 *             @OA\Property(property="descripcion", type="string", example="Un gran concierto de rock en la ciudad."),
 *             @OA\Property(property="tipo_evento", type="string", example="Concierto"),
 *             @OA\Property(property="fecha_conclusion", type="string", format="date", example="2024-12-31")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Evento creado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Eventos", ref="#/components/schemas/Evento"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/api/Eventos/{id}",
 *     summary="Obtener un evento específico",
 *     description="Recuperar los detalles de un evento por su ID.",
 *     operationId="getEventoById",
 *     tags={"Eventos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del evento a obtener",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Evento encontrado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Eventos", ref="#/components/schemas/Evento"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Evento no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/Eventos/{id}",
 *     summary="Actualizar un evento",
 *     description="Actualizar todos los datos de un evento existente.",
 *     operationId="updateEvento",
 *     tags={"Eventos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del evento a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_evento", type="string"),
 *             @OA\Property(property="descripcion", type="string"),
 *             @OA\Property(property="tipo_evento", type="string"),
 *             @OA\Property(property="fecha_conclusion", type="string", format="date")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Evento actualizado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Eventos", ref="#/components/schemas/Evento"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Evento no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Patch(
 *     path="/api/Eventos/{id}",
 *     summary="Actualizar parcialmente un evento",
 *     description="Actualizar uno o más datos de un evento existente.",
 *     operationId="updatePartialEvento",
 *     tags={"Eventos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del evento a actualizar parcialmente",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_evento", type="string"),
 *             @OA\Property(property="descripcion", type="string"),
 *             @OA\Property(property="tipo_evento", type="string"),
 *             @OA\Property(property="fecha_conclusion", type="string", format="date")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Evento actualizado parcialmente exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Eventos", ref="#/components/schemas/Evento"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Evento no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/Eventos/{id}",
 *     summary="Eliminar un evento",
 *     description="Eliminar un evento existente por su ID.",
 *     operationId="deleteEvento",
 *     tags={"Eventos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del evento a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Evento eliminado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Evento no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

class EventoController extends Controller
{

    public function obtenerAsistentesPorEvento($id)
    {
        $evento = Evento::with('asistentes')->find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado', 'status' => 404], 404);
        }

        if ($evento->asistentes->isEmpty()) {
            return response()->json([
                'Eventos' => $evento,
                'message' => 'Este evento todavía no tiene asistentes.',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'Eventos' => $evento,
            'status' => 200
        ], 200);
    }

    //mostrar todos los datos
    public function index(Request $request)
    {
        $tipo_evento = $request->query('tipo_evento');

        // Construir la consulta con o sin el filtro
        if ($tipo_evento) {
            // Filtrar por coincidencia exacta de tipo_evento
            $evento = Evento::where('tipo_evento', $tipo_evento)->paginate(5);

            // Si no se encontraron eventos con el filtro, devolver mensaje
            if ($evento->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontró ningún evento con ese tipo.',
                    'status' => 404
                ], 404);
            }
        } else {
            // Si no hay filtro, simplemente paginar todos los eventos
            $evento = Evento::paginate(5);
        }

        // Enviar la respuesta con los eventos encontrados o paginados
        $data = [
            'Eventos' => $evento,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //ingresar datos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_evento' => 'required|string',
            'descripcion' => 'nullable',
            'tipo_evento' => 'required|string',
            'fecha_conclusion' => 'required|date'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }
        $evento = Evento::create([
            'nombre_evento' => $request->nombre_evento,
            'descripcion' => $request->descripcion,
            'tipo_evento' => $request->tipo_evento,
            'fecha_conclusion' => $request->fecha_conclusion
        ]);

        if (!$evento) {
            $data = [
                'message' => 'Error al crear el Evento',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Eventos' => $evento,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    //mostrar un determinado registro
    public function show($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            $data = [
                'message' => 'Evento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Eventos' => $evento,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //eliminar
    public function destroy($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            $data = [
                'message' => 'Evento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $evento->delete();

        $data = [
            'message' => 'Evento eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar
    public function update(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            $data = [
                'message' => 'Evento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_evento' => 'required|string',
            'descripcion' => 'nullable',
            'tipo_evento' => 'required|string',
            'fecha_conclusion' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }
        $evento->nombre_evento = $request->nombre_evento;
        $evento->descripcion = $request->descripcion;
        $evento->tipo_evento = $request->tipo_evento;
        $evento->fecha_conclusion = $request->fecha_conclusion;

        $evento->save();

        $data = [
            'message' => 'Evento actualizado',
            'Eventos' => $evento,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            $data = [
                'message' => 'Evento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_evento' => 'max:255',
            'descripcion' => 'nullable',
            'tipo_evento' => 'max:255',
            'fecha_conclusion' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_evento')) {
            $evento->nombre_evento = $request->nombre_evento;
        }

        if ($request->has('descripcion')) {
            $evento->descripcion = $request->descripcion;
        }

        if ($request->has('tipo_evento')) {
            $evento->tipo_evento = $request->tipo_evento;
        }

        if ($request->has('fecha_conclusion')) {
            $evento->fecha_conclusion = $request->fecha_conclusion;
        }

        $evento->save();

        $data = [
            'message' => 'Evento actualizado',
            'Eventos' => $evento,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
