<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar el facade de Auth
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Usuarios",
 *     description="Operaciones relacionadas con los usuarios"
 * )
 */

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
 * @OA\Post(
 *     path="/api/login",
 *     tags={"Usuarios"},
 *     summary="Iniciar sesión",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login exitoso",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="user", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Credenciales incorrectas",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 * )
 */

/**
 * @OA\Get(
 *     path="/api/usuarios",
 *     tags={"Usuarios"},
 *     summary="Mostrar todos los usuarios",
 *     @OA\Parameter(
 *         name="rol",
 *         in="query",
 *         required=false,
 *         description="Filtrar usuarios por rol",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuarios",
 *         @OA\JsonContent(
 *             @OA\Property(property="Usuarios", type="array", @OA\Items(ref="#/components/schemas/User")),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró ningún usuario con ese rol",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/usuarios",
 *     tags={"Usuarios"},
 *     summary="Crear un nuevo usuario",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_user", type="string"),
 *             @OA\Property(property="rol", type="string"),
 *             @OA\Property(property="ci_user", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuario creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="token", type="string"),
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
 *     path="/api/usuarios/{id}",
 *     tags={"Usuarios"},
 *     summary="Mostrar un usuario específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/usuarios/{id}",
 *     tags={"Usuarios"},
 *     summary="Actualizar un usuario existente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_user", type="string"),
 *             @OA\Property(property="rol", type="string"),
 *             @OA\Property(property="ci_user", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario actualizado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
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
 * @OA\Delete(
 *     path="/api/usuarios/{id}",
 *     tags={"Usuarios"},
 *     summary="Eliminar un usuario",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario eliminado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     )
 * )
 */

/**
 * @OA\Patch(
 *     path="/api/usuarios/{id}",
 *     tags={"Usuarios"},
 *     summary="Actualizar parcialmente un usuario existente",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del usuario",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_user", type="string"),
 *             @OA\Property(property="rol", type="string"),
 *             @OA\Property(property="ci_user", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usuario actualizado parcialmente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="Usuarios", ref="#/components/schemas/User"),
 *             @OA\Property(property="status", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Usuario no encontrado",
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


class UserController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Si la autenticación es exitosa, obtener el usuario
            $user = Auth::user();
            // Devolver el rol del usuario y otros datos si es necesario
            return response()->json([
                'message' => 'Login exitoso',
                'user' => [
                    'id' => $user->id,
                    'nombre_user' => $user->nombre_user,
                    'rol' => $user->rol,
                ],
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Credenciales incorrectas',
                'status' => 401
            ], 401);
        }
    }
    // Mostrar todos los datos
    public function index(Request $request)
    {
        $rol = $request->query('rol');

        // Construir la consulta con o sin el filtro
        if ($rol) {
            $user = User::where('rol', $rol)->paginate(5);

            // Si no se encontraron usuarios con el filtro, devolver mensaje
            if ($user->isEmpty()) {
                return response()->json([
                    'message' => 'No se encontró ningún usuario con ese rol.',
                    'status' => 404
                ], 404);
            }
        } else {
            // Si no hay filtro, simplemente paginar todos los usuarios
            $user = User::paginate(5);
        }

        // Verificar si no hay usuarios en general
        if (!$rol && $user->isEmpty()) {
            return response()->json([
                'message' => 'No hay usuarios creados todavía.',
                'status' => 200
            ], 200);
        }

        // Enviar la respuesta con los usuarios encontrados o paginados
        $data = [
            'Usuarios' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    // Ingresar datos
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
            'password' => Hash::make($request->password),
        ]);

        // Generar un token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        if (!$user) {
            $data = [
                'message' => 'Error al crear Usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Usuarios' => $user,
            'token' => $token, // Devolver el token junto con el usuario
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    // Mostrar un determinado registro
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
        $this->authorizeUser('administrador');

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

    // Eliminar
    public function destroy($id)
    {
        $this->authorizeUser('administrador');

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

    // Actualizar un dato en específico
    public function updatePartial(Request $request, $id)
    {
        $this->authorizeUser('administrador');

        $user = User::find($id);

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

    // Método para autorizar usuario basado en rol
    private function authorizeUser($requiredRole = null)
    {
        if (!Auth::check()) {
            abort(401, 'No autorizado');
        }

        $user = Auth::user();
        if ($requiredRole && $user->rol !== $requiredRole) {
            abort(403, 'Acceso denegado');
        }
    }
}
