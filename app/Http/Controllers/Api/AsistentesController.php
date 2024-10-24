<?php

namespace App\Http\Controllers\Api;

use App\Models\Asistentes;
use App\Models\Evento;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Asistentes",
 *     description="Operaciones relacionadas con asistentes"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Asistente",
 *     type="object",
 *     required={"nombre_asistente", "ci_asistente", "telefono", "id_evento", "id_ubicacion"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID del asistente"),
 *     @OA\Property(property="nombre_asistente", type="string", description="Nombre del asistente"),
 *     @OA\Property(property="ci_asistente", type="string", description="Cédula de identidad del asistente"),
 *     @OA\Property(property="telefono", type="string", description="Teléfono del asistente"),
 *     @OA\Property(property="id_evento", type="integer", format="int64", description="ID del evento relacionado"),
 *     @OA\Property(property="id_ubicacion", type="integer", format="int64", description="ID de la ubicación relacionada"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización")
 * )
 */

/**
 * @OA\Get(
 *     path="/api/asistentes",
 *     tags={"Asistentes"},
 *     summary="Mostrar todos los asistentes",
 *     @OA\Response(
 *         response="200",
 *         description="Lista de asistentes",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Asistente"))
 *     ),
 *     @OA\Response(response="404", description="No se encontraron asistentes")
 * )
 */

/**
 * @OA\Post(
 *     path="/api/asistentes",
 *     tags={"Asistentes"},
 *     summary="Crear un nuevo asistente",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Asistente creado",
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(response="400", description="Error en la validación de los datos"),
 *     @OA\Response(response="404", description="El evento o la ubicación no existen")
 * )
 */

/**
 * @OA\Get(
 *     path="/api/asistentes/{id}",
 *     tags={"Asistentes"},
 *     summary="Mostrar un asistente específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Asistente encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(response="404", description="Asistente no encontrado")
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/asistentes/{id}",
 *     tags={"Asistentes"},
 *     summary="Eliminar un asistente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response="200", description="Asistente eliminado"),
 *     @OA\Response(response="404", description="Asistente no encontrado")
 * )
 */

/**
 * @OA\Put(
 *     path="/api/asistentes/{id}",
 *     tags={"Asistentes"},
 *     summary="Actualizar un asistente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Asistente actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(response="400", description="Error en la validación de los datos"),
 *     @OA\Response(response="404", description="Asistente no encontrado")
 * )
 */

/**
 * @OA\Patch(
 *     path="/api/asistentes/{id}/partial",
 *     tags={"Asistentes"},
 *     summary="Actualizar parcialmente un asistente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_asistente", type="string", example="Juan Pérez"),
 *             @OA\Property(property="ci_asistente", type="string", example="12345678"),
 *             @OA\Property(property="telefono", type="string", example="987654321")
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Asistente actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/Asistente")
 *     ),
 *     @OA\Response(response="400", description="Error en la validación de los datos"),
 *     @OA\Response(response="404", description="Asistente no encontrado")
 * )
 */

class AsistentesController extends Controller
{
    //mostrar todos los datos
    public function index(Request $request)
    {
        $query = Asistentes::query(); // Inicia una consulta sobre el modelo Asistentes
    
        // Filtrar por nombre_asistente
        if ($request->has('nombre_asistente')) {
            $query->where('nombre_asistente', 'like', '%' . $request->nombre_asistente . '%');
        }
    
        $asistentes = $query->paginate(5); // Paginación de 5 por página
    
        // Verificar si no hay asistentes con el filtro aplicado
        if ($request->has('nombre_asistente') && $asistentes->isEmpty()) {
            return response()->json([
                'message' => 'No se encontró ningún asistente con ese nombre.',
                'status' => 404
            ], 404);
        }
    
        // Verificar si no hay asistentes en general
        if (!$request->has('nombre_asistente') && $asistentes->isEmpty()) {
            return response()->json([
                'message' => 'No hay asistentes creados todavía.',
                'status' => 200
            ], 200);
        }
    
        // Enviar la respuesta con los asistentes encontrados o paginados
        $data = [
            'Asistentes' => $asistentes,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }
    

    //ingresar datos
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre_asistente' => 'required|string',
            'ci_asistente' => 'required|string|unique:asistentes',
            'telefono' => 'required|string|unique:asistentes',
            'id_evento' => 'required|exists:evento,id_evento', 
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion'
        ]);

        // Si la validación falla, devolver errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Verificar si el evento y la ubicación existen
        $evento = Evento::find($request->id_evento);
        $ubicacion = Ubicacion::find($request->id_ubicacion);

        if (!$evento) {
            return response()->json(['message' => 'El evento no existe.'], 404);
        }

        if (!$ubicacion) {
            return response()->json(['message' => 'La ubicación no existe.'], 404);
        }

        // Si todo está bien, crear el asistente
        $asistente = Asistentes::create([
            'nombre_asistente' => $request->nombre_asistente,
            'ci_asistente' => $request->ci_asistente,
            'telefono' => $request->telefono,
            'id_evento' => $request->id_evento,  // Relación con el evento
            'id_ubicacion' => $request->id_ubicacion  // Relación con la ubicación
        ]);

        if (!$asistente) {
            return response()->json([
                'message' => 'Error al crear el Asistente',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'Asistentes' => $asistente,
            'status' => 201
        ], 201);
    }

    //mostrar un determinado registro
    public function show($id)
    {
        $asistentes = Asistentes::find($id);

        if (!$asistentes) {
            $data = [
                'message' => 'Asistente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Asistentes' => $asistentes,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //eliminar
    public function destroy($id)
    {
        $asistentes = Asistentes::find($id);

        if (!$asistentes) {
            $data = [
                'message' => 'Asistente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $asistentes->delete();

        $data = [
            'message' => 'Asistente eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //actualizar
    public function update(Request $request, $id)
    {
        $asistentes = Asistentes::find($id);

        if (!$asistentes) {
            $data = [
                'message' => 'Asistente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_asistente' => 'required|string',
            'ci_asistente' => 'required|string',
            'telefono' => 'required|string',
            'id_evento' => 'required|exists:evento,id_evento',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $asistentes->nombre_asistente = $request->nombre_asistente;
        $asistentes->ci_asistente = $request->ci_asistente;
        $asistentes->telefono = $request->telefono;

        $asistentes->save();

        $data = [
            'message' => 'Asistente actualizado',
            'Asistentes' => $asistentes,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {
        $asistentes = Asistentes::find($id);

        if (!$asistentes) {
            $data = [
                'message' => 'Asistente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_asistente' => 'max:255',
            'ci_asistente' => 'max:50',
            'telefono' => 'max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_asistente')) {
            $asistentes->nombre_asistente = $request->nombre_asistente;
        }

        if ($request->has('ci_asistente')) {
            $asistentes->ci_asistente = $request->ci_asistente;
        }

        if ($request->has('telefono')) {
            $asistentes->telefono = $request->telefono;
        }

        $asistentes->save();

        $data = [
            'message' => 'Asistente actualizado',
            'Asistentes' => $asistentes,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
