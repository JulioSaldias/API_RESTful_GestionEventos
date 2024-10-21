<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return response()->json([
            'Usuarios' => $users,
            'status' => 200
        ], 200);

        

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
                'message' => 'Error al crear la user',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Usuario' => $user,
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
                'message' => 'user no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Usuario' => $user,
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
             'Usuario' => $user,
             'status' => 200
         ], 200);
     }
 
    //eliminar
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'user no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $user->delete();

        $data = [
            'message' => 'user eliminada',
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
                'message' => 'user no encontrada',
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
            'message' => 'user actualizada',
            'Usuario' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}