<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    //mostrar todos los datos
    public function index()
    {
        $cliente = Cliente::paginate(5);
        $data = [
            'Clientes' => $cliente,
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