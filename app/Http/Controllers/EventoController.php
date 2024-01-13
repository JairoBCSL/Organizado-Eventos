<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::all();
        //die('<pre>'.$eventos[0]->descricao.'</pre>');

        // Listar eventos (GetAll)
        // Listar para gerir (GetByOrg) -> (Create, Edit e Manage) (Faz os filtro no vue, Zé)
        return view('evento.index')->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Criar evento (Create) (Store)
        return view('evento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detalhar evento (Get)
        return view('evento.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Editar evento (Edit) (Update)
        return view('evento.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function manage(Request $request, string $id)
    {
        // Gerir evento (Manage) -> (Lista inscritos)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
