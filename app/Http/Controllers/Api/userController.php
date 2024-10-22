<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nombre_user", type="string"),
 *     @OA\Property(property="rol", type="string"),
 *     @OA\Property(property="ci_user", type="string"),
 *     @OA\Property(property="email", type="string"),
 * )
 */

/**
 * @OA\Tag(
 *     name="Usuarios",
 *     description="Operaciones relacionadas con los usuarios"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/Usuarios",
 *     summary="Listar todos los usuarios",
 *     description="Obtener una lista de todos los usuarios. Se puede aplicar un filtro por rol.",
 *     operationId="getUsuarios",
 *     tags={"Usuarios"},
 *     @OA\Parameter(
 *         name="rol",
 *         in="query",
 *         required=false,
 *         description="Filtrar usuarios por rol",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuarios obtenida exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Usuarios", type="array", @OA\Items(ref="#/components/schemas/User")),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró ningún usuario con ese rol.",
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
 *     path="/api/Usuarios",
 *     summary="Crear un nuevo usuario",
 *     description="Registrar un nuevo usuario en el sistema.",
 *     operationId="createUsuario",
 *     tags={"Usuarios"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_user", type="string", example="Juan Pérez"),
 *             @OA\Property(property="rol", type="string", example="administrador"),
 *             @OA\Property(property="ci_user", type="string", example="12345678"),
 *             @OA\Property(property="email", type="string", example="juan.perez@example.com"),
 *             @OA\Property(property="password", type="string", example="secreta123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuario creado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
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
 *     path="/api/Usuarios/{id}",
 *     summary="Obtener un usuario específico",
 *     description="Recuperar los detalles de un usuario por su ID.",
 *     operationId="getUsuarioById",
 *     tags={"Usuarios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario a obtener",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario encontrado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
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
 *     path="/api/Usuarios/{id}",
 *     summary="Actualizar un usuario",
 *     description="Actualizar todos los datos de un usuario existente.",
 *     operationId="updateUsuario",
 *     tags={"Usuarios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_user", type="string"),
 *             @OA\Property(property="rol", type="string"),
 *             @OA\Property(property="ci_user", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario actualizado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
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
 *     path="/api/Usuarios/{id}",
 *     summary="Actualizar parcialmente un usuario",
 *     description="Actualizar uno o más datos de un usuario existente.",
 *     operationId="updatePartialUsuario",
 *     tags={"Usuarios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario a actualizar parcialmente",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre_user", type="string"),
 *             @OA\Property(property="rol", type="string"),
 *             @OA\Property(property="ci_user", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario actualizado parcialmente exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
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
 *     path="/api/Usuarios/{id}",
 *     summary="Eliminar un usuario",
 *     description="Eliminar un usuario existente por su ID.",
 *     operationId="deleteUsuario",
 *     tags={"Usuarios"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario eliminado exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

class userController extends Controller
{
    //mostrar todos los datos
    public function index(Request $request)
    {
        $rol = $request->query('rol');

        // Construir la consulta con o sin el filtro
        if ($rol) {
            $user = User::where('rol', $rol)->paginate(5);

            if ($user->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontró ningún usuario con ese rol.',
                    'status' => 404
                ], 404);
            }
        } else {

            $user = User::paginate(5);
        }

        $data = [
            'Usuarios' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre_user' => 'required|max:255',
            'rol' => 'required|in:administrador,moderador',
            'ci_user' => 'required|unique:users|max:20',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user = User::create([
            'nombre_user' => $request->nombre_user,
            'rol' => $request->rol,
            'ci_user' => $request->ci_user,
            'email' => $request->email,
            'password' => Hash::make($request->password), //encripta la contraseña
        ]);

        if (!$user) {
            $data = [
                'message' => 'Error al crear Usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Usuarios' => $user,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    //mostrar un determinado registro
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Usuarios' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_user' => 'max:255',
            'rol' => 'in:administrador,moderador',
            'ci_user' => 'max:20|unique:users,ci_user,' . $id,
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('nombre_user')) {
            $user->nombre_user = $request->nombre_user;
        }
        if ($request->has('rol')) {
            $user->rol = $request->rol;
        }
        if ($request->has('ci_user')) {
            $user->ci_user = $request->ci_user;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuario actualizado',
            'Usuarios' => $user,
            'status' => 200
        ], 200);
    }

    //eliminar
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $user->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {

        $user = user::find($id);

        if (!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_user' => 'max:255',
            'rol' => 'in:administrador,moderador',
            'ci_user' => 'max:20|unique:users,ci_user,' . $id,
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'min:8',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_user')) {
            $user->nombre_user = $request->nombre_user;
        }
        if ($request->has('rol')) {
            $user->rol = $request->rol;
        }
        if ($request->has('ci_user')) {
            $user->ci_user = $request->ci_user;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $data = [
            'message' => 'Usuario actualizado',
            'Usuarios' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
