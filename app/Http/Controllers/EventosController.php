<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index()
    {
        $agendamentos = Eventos::all();
        return view('welcome', ['agendamentos' => $agendamentos]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'evento' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'inicio' => 'required',
            'fim' => 'required',
            'check_repete' => 'required'
        ]); {
            if ($request->check_repete == "on") {
                for ($i = 0; $i < (int)$request->intervalo_semanas; $i++) {
                    Eventos::create([
                        'name' => $request->evento,
                        'description' => $request->descricao,
                        'time' => Carbon::parse($request->data)->addDays(7 * $i),
                        'start_time' => $request->inicio,
                        'end_time' => $request->fim
                    ]);
                }
            } else {
                Eventos::create([
                    'name' => $request->evento,
                    'description' => $request->descricao,
                    'time' => $request->data,
                    'start_time' => $request->inicio,
                    'end_time' => $request->fim
                ]);
            }
            return redirect(route("home"));
        }
    }
}
