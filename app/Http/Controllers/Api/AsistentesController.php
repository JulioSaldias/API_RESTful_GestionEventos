<?php

namespace App\Http\Controllers\Api;

use App\Models\Asistentes;
use App\Models\Evento;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AsistentesController extends Controller
{
    //mostrar todos los datos
    public function index(Request $request)
    {
        $query = Asistentes::query();
        if ($request->has('nombre_asistente')) {
            $query->where('nombre_asistente', 'like', '%' . $request->nombre_asistente . '%');
        }

        $asistente = $query->paginate(5); 

        if ($asistente->isEmpty()) {
            return response()->json([
                'message' => 'No se encontró ningún asistente con ese nombre.',
                'status' => 404
            ], 404);
        }

        $data = [
            'Asistentes' => $asistente,
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
            'id_evento' => 'required|exists:evento,id_evento',  // Asegúrate que la tabla es "evento"
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
