<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index(Request $request)
    {
        $includeProperties = $request->query('includeProperties', false);
        if ($includeProperties) {
            $asesores = Asesor::with('properties')->get();
            return response()->json(['data' => $asesores],200);
        }
        $asesores = Asesor::all();
        return response()->json(['data' => $asesores], 200);
    }

    public function show($id, Request $request)
    {
        $includeProperties = $request->query('includeProperties', false);
        if ($includeProperties) {
            $asesor = Asesor::with('properties')->findOrFail($id);
            if ($asesor->properties->isEmpty()) {
                return response()->json(['data' => $asesor],404);
            }
        }
        $asesor = Asesor::find($id);

        //si no existe el asesor con el id proporcionado se retorna un error 404
        if (!$asesor) {
            return response()->json(['data'=>['message' => 'Recurso no eencontrado']], 404);
        }
        return response()->json(['data' => $asesor], 200);

    }
}
