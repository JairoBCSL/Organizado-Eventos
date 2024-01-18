<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Inscricao;
use App\Models\Evento;

class InscricaoController extends Controller
{
    public $inscricao;

    public function __construct(Inscricao $inscricao) {
        $this->inscricao = $inscricao;
    }

    public function list()
    {
        $user = Auth::user();
        $inscricoes = Inscricao::with('pagamento.forma', 'evento.local.cidade', 'status')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        // dd($inscricoes);
        return view('inscricao.list', ['inscricoes' => $inscricoes]);
    }

    public function create(string $eventoId)
    {
        $evento = Evento::find($eventoId);

        if($evento === null) {
            return redirect()->route('evento.index');
        }

        $inscricao = Inscricao::all()->where('evento_id', $eventoId)->where('status_id', '!=', 8);

        if(count($inscricao) >= $evento->capacidade) {
            return redirect()->route('evento.show', ['id' => $eventoId]);
        }

        if(count($inscricao->where('user_id', Auth::user()->id)) > 0) {
            return redirect()->route('evento.show', ['id' => $eventoId]);
        }

        return view('inscricao.create', ['evento_id' => $eventoId]);
    }

    public function store(Request $request)
    {
        $usuario = Auth::user();

        if(!($usuario && Hash::check($request->password, $usuario->password))) {
            $validator = Validator::make([], []);
            $validator->errors()->add('password', 'Senha incorreta. Verifique suas credenciais');
            throw new ValidationException($validator);
        }

        $evento = Evento::find($request->evento_id);

        if($evento === null) {
            return redirect()->route('evento.index');
        }

        $inscricao = Inscricao::all()->where('evento_id', $request->evento_id)->where('status_id', '!=', 8);

        if(count($inscricao) >= $evento->capacidade) {
            return redirect()->route('evento.show', ['id' => $request->evento_id]);
        }

        if(count($inscricao->where('user_id', Auth::user()->id)) > 0) {
            return redirect()->route('evento.show', ['id' => $request->evento_id]);
        }

        $request->validate($this->inscricao->rules(), $this->inscricao->feedback());

        $inscricao = $this->inscricao->create([
            'user_id' => $request->user_id,
            'evento_id' => $request->evento_id,
            'status_id' => 5, // Aguardando pagamento
            'forma_pagamento_id' => $request->forma_pagamento_id
        ]);

        $inscricao = Inscricao::all()->where('evento_id', $request->evento_id)->where('status_id', '!=', 8);

        if(count($inscricao) >= $evento->capacidade) {
            $evento->update([
                'status_id' => 3, // Inscrições Encerradas
            ]);
        }

        return redirect()->route('inscricao.list');
    }

    public function cancel(Request $request)
    {
        $usuario = Auth::user();

        if(!($usuario && Hash::check($request->password, $usuario->password))) {
            $validator = Validator::make([], []);
            $validator->errors()->add('password', 'Senha incorreta. Verifique suas credenciais');
            throw new ValidationException($validator);
        }

        $inscricao = Inscricao::find($request->inscricao_id);
        $usuario = Auth::user();

        if($inscricao->user_id != $usuario->id) {
            return redirect()->route('inscricao.list');
        }

        $inscricao = $inscricao->update([
            'status_id' => 8, // Cancelada
        ]);

        return redirect()->route('inscricao.list');
    }
}
