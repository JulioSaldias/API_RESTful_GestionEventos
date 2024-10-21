<?php

namespace App\Http\Controllers\Api;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="Ubicacion",
 *     type="object",
 *     title="Ubicacion",
 *     description="Modelo de la ubicación",
 *     @OA\Property(property="id_ubicacion", type="integer", example=1),
 *     @OA\Property(property="nombre_ubicacion", type="string", example="Sala A"),
 *     @OA\Property(property="capacidad", type="integer", example=100),
 *     @OA\Property(property="descripcion", type="string", example="Ubicación principal para eventos"),
 * )
 */



/**
 * @OA\Tag(
 *     name="Ubicaciones",
 *     description="Operaciones relacionadas con las ubicaciones"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/ubicaciones",
 *     tags={"Ubicaciones"},
 *     summary="Mostrar todas las ubicaciones",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de ubicaciones",
 *         @OA\JsonContent(ref="#/components/schemas/Ubicacion")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontraron ubicaciones",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No se encontró ninguna mesa con esa capacidad."),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/ubicaciones",
 *     tags={"Ubicaciones"},
 *     summary="Agregar una nueva ubicación",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_ubicacion", type="string", example="Sala A"),
 *             @OA\Property(property="capacidad", type="integer", example=100),
 *             @OA\Property(property="descripcion", type="string", example="Ubicación principal para eventos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Ubicación creada con éxito",
 *         @OA\JsonContent(ref="#/components/schemas/Ubicacion")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error en la validación de los datos"),
 *             @OA\Property(property="status", type="integer", example=400)
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/api/ubicaciones/{id}",
 *     tags={"Ubicaciones"},
 *     summary="Mostrar una ubicación específica",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ubicación encontrada",
 *         @OA\JsonContent(ref="#/components/schemas/Ubicacion")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ubicación no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Ubicacion no encontrada"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/ubicaciones/{id}",
 *     tags={"Ubicaciones"},
 *     summary="Eliminar una ubicación",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ubicación eliminada",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Ubicacion eliminada"),
 *             @OA\Property(property="status", type="integer", example=200)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ubicación no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Ubicacion no encontrada"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/ubicaciones/{id}",
 *     tags={"Ubicaciones"},
 *     summary="Actualizar una ubicación",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_ubicacion", type="string", example="Sala A"),
 *             @OA\Property(property="capacidad", type="integer", example=100),
 *             @OA\Property(property="descripcion", type="string", example="Ubicación principal para eventos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ubicación actualizada",
 *         @OA\JsonContent(ref="#/components/schemas/Ubicacion")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ubicación no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Ubicacion no encontrada"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error en la validación de los datos"),
 *             @OA\Property(property="status", type="integer", example=400)
 *         )
 *     )
 * )
 */

/**
 * @OA\Patch(
 *     path="/api/ubicaciones/{id}",
 *     tags={"Ubicaciones"},
 *     summary="Actualizar parcialmente una ubicación",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_ubicacion", type="string", example="Sala A"),
 *             @OA\Property(property="capacidad", type="integer", example=100),
 *             @OA\Property(property="descripcion", type="string", example="Ubicación principal para eventos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ubicación actualizada",
 *         @OA\JsonContent(ref="#/components/schemas/Ubicacion")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ubicación no encontrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Ubicacion no encontrada"),
 *             @OA\Property(property="status", type="integer", example=404)
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error en la validación de los datos"),
 *             @OA\Property(property="status", type="integer", example=400)
 *         )
 *     )
 * )
 */

class UbicacionController extends Controller
{
    //mostrar todos los datos
    public function index(Request $request)
    {
        $query = Ubicacion::query(); // Inicia una consulta sobre el modelo Evento

        // Filtrar por tipo_evento
        if ($request->has('capacidad')) {
            $query->where('capacidad', 'like', '%' . $request->capacidad . '%');
        }

        $ubicacion = $query->paginate(5); // Paginación de 5 por página

        if ($ubicacion->isEmpty()) {
            return response()->json([
                'message' => 'No se encontró ningúna mesa con esa capacidad.',
                'status' => 404
            ], 404);
        }

        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //ingresar datos
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'required|max:255',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $ubicacion = Ubicacion::create([
            'nombre_ubicacion' => $request->nombre_ubicacion,
            'capacidad' => $request->capacidad,
            'descripcion' => $request->descripcion,
        ]);

        if (!$ubicacion) {
            $data = [
                'message' => 'Error al crear la Ubicacion',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    //mostrar un determinado registro
    public function show($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //eliminar
    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $ubicacion->delete();

        $data = [
            'message' => 'Ubicacion eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar
    public function update(Request $request, $id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'required|max:255',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }
        $ubicacion->nombre_ubicacion = $request->nombre_ubicacion;
        $ubicacion->capacidad = $request->capacidad;
        $ubicacion->descripcion = $request->descripcion;

        $ubicacion->save();

        $data = [
            'message' => 'Ubicacion actualizada',
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {

        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'max:255',
            'capacidad' => 'integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_ubicacion')) {
            $ubicacion->nombre_ubicacion = $request->nombre_ubicacion;
        }

        if ($request->has('capacidad')) {
            $ubicacion->capacidad = $request->capacidad;
        }

        if ($request->has('descripcion')) {
            $ubicacion->descripcion = $request->descripcion;
        }

        $ubicacion->save();

        $data = [
            'message' => 'Ubicacion actualizada',
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
