<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    //mostrar todos los datos
    public function index()
    {
        $evento = Evento::paginate(5);
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
