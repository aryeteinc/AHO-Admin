<?php

namespace App\Http\Controllers;


use App\Models\Asesor;
use Inertia\Inertia;

class AsesorController extends Controller
{
    public function show(): \Inertia\Response
    {
        $asesors = Asesor::all();
        return Inertia::render('Asesor/Show', [
            'asesors' => $asesors
        ]);
    }
}
