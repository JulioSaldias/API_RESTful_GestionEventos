<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Cliente",
 *     type="object",
 *     required={"nombre_cliente", "ci_cliente", "telefono", "correo"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID del cliente"),
 *     @OA\Property(property="nombre_cliente", type="string", description="Nombre del cliente"),
 *     @OA\Property(property="ci_cliente", type="string", description="Cédula de identidad del cliente"),
 *     @OA\Property(property="telefono", type="string", description="Teléfono del cliente"),
 *     @OA\Property(property="correo", type="string", format="email", description="Correo electrónico del cliente"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización")
 * )
 */

/**
 * 
 * 
 * 
 * @OA\Tag(
 *     name="Clientes",
 *     description="Operaciones relacionadas con los clientes"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/clientes",
 *     tags={"Clientes"},
 *     summary="Listar todos los clientes",
 *     description="Obtiene una lista de todos los clientes. Se puede aplicar un filtro por nombre.",
 *     operationId="getClientes",
 *     @OA\Parameter(
 *         name="nombre_cliente",
 *         in="query",
 *         description="Filtrar clientes por nombre",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de clientes obtenida exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="Clientes",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/Cliente")
 *             ),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró ningún cliente con ese nombre.",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/clientes",
 *     tags={"Clientes"},
 *     summary="Crear un nuevo cliente",
 *     description="Registrar un nuevo cliente en el sistema.",
 *     operationId="createCliente",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_cliente", type="string", example="Juan Pérez"),
 *             @OA\Property(property="ci_cliente", type="string", example="12345678"),
 *             @OA\Property(property="telefono", type="string", example="987654321"),
 *             @OA\Property(property="correo", type="string", example="juan.perez@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Cliente creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="Clientes", ref="#/components/schemas/Cliente"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/api/clientes/{id}",
 *     tags={"Clientes"},
 *     summary="Obtener un cliente específico",
 *     description="Recuperar los detalles de un cliente por su ID.",
 *     operationId="getClienteById",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del cliente a obtener",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente encontrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="Clientes", ref="#/components/schemas/Cliente"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/clientes/{id}",
 *     tags={"Clientes"},
 *     summary="Eliminar un cliente",
 *     description="Eliminar un cliente existente por su ID.",
 *     operationId="deleteCliente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del cliente a eliminar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente eliminado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/clientes/{id}",
 *     tags={"Clientes"},
 *     summary="Actualizar un cliente",
 *     description="Actualizar un cliente existente por su ID.",
 *     operationId="updateCliente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del cliente a actualizar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_cliente", type="string", example="Juan Pérez"),
 *             @OA\Property(property="ci_cliente", type="string", example="12345678"),
 *             @OA\Property(property="telefono", type="string", example="987654321"),
 *             @OA\Property(property="correo", type="string", example="juan.perez@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="Clientes", ref="#/components/schemas/Cliente"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Patch(
 *     path="/api/clientes/{id}/actualizar-parcial",
 *     tags={"Clientes"},
 *     summary="Actualizar parcialmente un cliente",
 *     description="Actualizar un cliente existente parcialmente por su ID.",
 *     operationId="updatePartialCliente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del cliente a actualizar",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_cliente", type="string", example="Juan Pérez"),
 *             @OA\Property(property="ci_cliente", type="string", example="12345678"),
 *             @OA\Property(property="telefono", type="string", example="987654321"),
 *             @OA\Property(property="correo", type="string", example="juan.perez@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cliente actualizado parcialmente exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="Clientes", ref="#/components/schemas/Cliente"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Cliente no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la validación de los datos",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */


class ClienteController extends Controller
{
    //mostrar todos los datos
    public function index(Request $request)
    {
        $query = Cliente::query(); // Inicia una consulta sobre el modelo Cliente

        // Filtrar por nombre_cliente
        if ($request->has('nombre_cliente')) {
            $query->where('nombre_cliente', 'like', '%' . $request->nombre_cliente . '%');
        }

        $clientes = $query->paginate(5); // Paginación de 5 por página

        if ($clientes->isEmpty()) {
            return response()->json([
                'message' => 'No se encontró ningún cliente con ese nombre.',
                'status' => 404
            ], 404);
        }

        $data = [
            'Clientes' => $clientes,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //ingresar datos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_cliente' => 'required|max:255',
            'ci_cliente' => 'required|max:30',
            'telefono' => 'required|max:30',
            'correo' => 'required|email|unique:Cliente'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $cliente = Cliente::create([
            'nombre_cliente' => $request->nombre_cliente,
            'ci_cliente' => $request->ci_cliente,
            'telefono' => $request->telefono,
            'correo' => $request->correo
        ]);

        if (!$cliente) {
            $data = [
                'message' => 'Error al crear al Cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Clientes' => $cliente,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    //mostrar un determinado registro
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Clientes' => $cliente,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //eliminar
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $cliente->delete();

        $data = [
            'message' => 'Cliente eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_cliente' => 'required|max:255',
            'ci_cliente' => 'required|max:30',
            'telefono' => 'required|max:30',
            'correo' => 'required|email|unique:Cliente'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->ci_cliente = $request->ci_cliente;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;

        $cliente->save();

        $data = [
            'message' => 'Cliente actualizado',
            'Clientes' => $cliente,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {

        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_cliente' => 'max:255',
            'ci_cliente' => 'max:30',
            'telefono' => 'max:30',
            'correo' => 'email|unique:Cliente',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_cliente')) {
            $cliente->nombre_cliente = $request->nombre_cliente;
        }

        if ($request->has('ci_cliente')) {
            $cliente->ci_cliente = $request->ci_cliente;
        }

        if ($request->has('telefono')) {
            $cliente->telefono = $request->telefono;
        }

        if ($request->has('correo')) {
            $cliente->correo = $request->correo;
        }

        $cliente->save();

        $data = [
            'message' => 'Cliente actualizado',
            'Clientes' => $cliente,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
