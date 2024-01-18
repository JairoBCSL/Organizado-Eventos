<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Inscricao;
use App\Models\Pagamento;

class PagamentoController extends Controller
{
    public $pagamento;

    public function __construct(Pagamento $pagamento) {
        $this->pagamento = $pagamento;
    }

    public function create(Request $request)
    {
        $usuario = Auth::user();

        if(!($usuario && Hash::check($request->password, $usuario->password))) {

            $validator = Validator::make([], []);
            $validator->errors()->add('password', 'Senha incorreta. Verifique suas credenciais');
            throw new ValidationException($validator);
        }

        // Verificar se a inscrição existe
        $inscricao = Inscricao::with('evento', 'pagamento')->find($request->inscricao_id);
        // dd($inscricao->pagamento);
        if ($inscricao === null){
            return redirect()->route('inscricao.list');
        }

        // Verifica se pertence ao usuário
        if ($inscricao->user_id != Auth::user()->id){
            return redirect()->route('inscricao.list');
        }

        // Verifica se já há um pagamento
        if($inscricao->pagamento && $inscricao->pagamento->where('status_id', '!=', 12)->count()){
            return redirect()->route('inscricao.list');
        }

        return view('pagamento.create')->with('inscricao', $inscricao);
        // Exibe QR e input pra colocar o comprovante
    }

    public function store(Request $request)
    {
        // Verificar se a inscrição existe
        $inscricao = Inscricao::with('evento', 'pagamento')->find($request->inscricao_id);

        if ($inscricao === null) {
            return redirect()->route('inscricao.list');
        }

        // Verifica se pertence ao usuário
        if ($inscricao->user_id != Auth::user()->id){
            return redirect()->route('inscricao.list');
        }

        // Verifica se já há um pagamento
        if($inscricao->pagamento && $inscricao->pagamento->where('status_id', '!=', 12)->count()){
            return redirect()->route('inscricao.list');
        }

        // Valida e grava
        $request->validate($this->pagamento->rules(), $this->pagamento->feedback());
        $comprovante = $request->file('comprovante');
        $comprovanteUrn = $comprovante->store('imagens/comprovante', 'public');

        $this->pagamento->create([ //'user_id', 'inscricao_id', 'forma_pagamento_id', 'valor', 'status_id', 'comprovante'
            'user_id' => Auth::user()->id,
            'inscricao_id' => $inscricao->id,
            'forma_pagamento_id' => $inscricao->forma_pagamento_id,
            'valor' => $inscricao->evento->preco,
            'status_id' => 11, // Em processamento
            'comprovante' => $comprovanteUrn,
        ]);

        $inscricao = $inscricao->update([
            'status_id' => 6, // Processando Pagamento
        ]);

        return redirect()->route('inscricao.list');
    }

    public function approve(string $id)
    {
        // Verificar se o pagamento existe
        $pagamento = Pagamento::with('inscricao.evento', 'inscricao.usuario')->find($id);

        if($pagamento === null) {
            return redirect()->route('inscricao.list');
        }

        // Verificar se o pagamento pertence a uma inscrição de um de seus eventos
        if(!$pagamento->inscricao || !$pagamento->inscricao->evento || ($pagamento->inscricao->evento->user_id != Auth::user()->id)){
            return redirect()->route('inscricao.list');
        }

        $pagamento->update([
            'status_id' => 10, // Aprovado
        ]);

        $pagamento->inscricao->update([
            'status_id' => 7, // Aprovada
        ]);

        return redirect()->route('inscricao.list');
        // Aprovar o pagamento
        // Mudar o status do pagamento e da inscrição
    }

    public function reject(string $id)
    {
        // Verificar se o pagamento existe
        $pagamento = Pagamento::with('inscricao.evento', 'inscricao.usuario')->find($id);

        if($pagamento === null) {
            return redirect()->route('inscricao.list');
        }

        // Verificar se o pagamento pertence a uma inscrição de um de seus eventos
        if(!$pagamento->inscricao || !$pagamento->inscricao->evento || ($pagamento->inscricao->evento->user_id != Auth::user()->id)){
            return redirect()->route('inscricao.list');
        }

        $pagamento->update([
            'status_id' => 12, // Recusado
        ]);

        $pagamento->inscricao->update([
            'status_id' => 9, // Recusada
        ]);

        return redirect()->route('inscricao.list');
        // Recusar o pagamento
        // Mudar o status do pagamento e da inscrição
    }
}
