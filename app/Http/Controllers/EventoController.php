<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Evento;
use App\Models\Cidade;
use App\Models\Inscricao;

class EventoController extends Controller
{
    public $evento;

    public function __construct(Evento $evento) {
        $this->evento = $evento;
    }

    public function index()
    {
        if (isset(Auth::user()->id)) {
            //$eventosPerto = Evento::all()->where('user_id', Auth::user()->id); // Perto de mim

            //return view('evento.index')->with('eventos', $eventos);
        }

        $eventos = Evento::with('inscricoes.pagamento', 'local.cidade', 'status')->get();

        return view('evento.index')->with('eventos', $eventos);
    }

    public function list()
    {
        $user = Auth::user();
        $eventos = Evento::with('inscricoes.pagamento', 'local.cidade', 'status')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('evento.list')->with('eventos', $eventos);
    }

    public function create()
    {
        $cidades = Cidade::all();
        $cidades->load('locais');

        return view('evento.create', ['cidades' => $cidades]);
    }

    public function store(Request $request)
    {
        $request->validate($this->evento->rules(), $this->evento->feedback());
        $thumb = $request->file('thumbnail');
        $thumbUrn = $thumb->store('imagens/thumbnail', 'public');
        $imagem = $request->file('imagem');
        $urn = $imagem->store('imagens/banner', 'public');
        $unico = ($request->data_inicio == $request->data_fim);
        $this->evento->create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'imagem' => $urn,
            'thumbnail' => $thumbUrn,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'dia_unico' => $unico,
            'local_id' => $request->local_id,
            'user_id' => $request->user_id,
            'capacidade' => $request->capacidade,
            'preco' => $request->preco,
            'qrcode' => $request->qrcode,
            'status_id' => 1,
        ]);

        return redirect()->route('evento.list');
    }

    public function show(string $id)
    {
        $evento = Evento::where('id', $id)->first();

        if($evento === null) {
            return redirect()->route('evento.index');
        }

        return view('evento.show', ['evento' => $evento]);
    }

    public function manage($eventoId)
    {
        $user = Auth::user();
        $evento = Evento::find($eventoId);

        if($evento->user_id != $user->id) {
            return redirect()->route('evento.list');
        }

        $inscricoes = Inscricao::with('status', 'evento.local.cidade', 'usuario', 'pagamento.status')->where('evento_id', $eventoId)->get();

        return view('evento.manage')->with('inscricoes', $inscricoes)->with('evento', $evento->titulo);
    }

    public function edit(string $id)
    {
        $evento = Evento::where('id', $id)->first();

        if($evento->user_id != Auth::user()->id) {
            return redirect('/evento/list');
        }

        $evento->local->cidade;
        $cidades = Cidade::all();
        // Editar evento (Edit) (Update)
        return view('evento.edit', ['evento' => $evento, 'cidades' => $cidades]);
    }

    public function update(Request $request, string $id)
    {
        $evento = $this->evento->find($id);

        if($evento === null) {
            return response()->json(['error' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }
        if($request->get('_method') === 'patch') {

            $regrasDinamicas = array();

            foreach($this->evento->rules() as $input => $regra) {
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $this->evento->feedback());
        } else {
            $request->validate($this->evento->rules(), $this->evento->feedback());
        }

        if ($request->file('thumbnail')){
            $thumb = $request->file('thumbnail');
            $thumbUrn = $thumb->store('imagens/thumbnail', 'public');
            Storage::disk('public')->delete($evento->thumbnail);
        }

        if ($request->file('imagem')){
            $imagem = $request->file('imagem');
            $urn = $imagem->store('imagens/banner', 'public');
            Storage::disk('public')->delete($evento->imagem);
        }

        $unico = null;
        if ($request->periodo) {
            if ($request->data_inicio == $request->data_fim) {
                $unico = 1;
            }
            else {
                $unico = 0;
            }
        }

        $evento->update([
            'titulo' => $request->titulo ?? $evento->titulo,
            'descricao' => $request->descricao ?? $evento->descricao,
            'imagem' => $urn ?? $evento->imagem,
            'thumbnail' => $thumbUrn ?? $evento->thumbnail,
            'data_inicio' => $request->data_inicio ?? $evento->data_inicio,
            'data_fim' => $request->data_fim ?? $evento->data_fim,
            'dia_unico' => $unico ?? $evento->dia_unico,
            'user_id' => $evento->user_id,
            'local_id' => $request->local_id ?? $evento->local_id,
            'capacidade' => $request->capacidade ?? $evento->capacidade,
            'preco' => $request->preco ?? $evento->preco,
            'qrcode' => $request->qrcode ?? $evento->qrcode,
        ]);

        return redirect()->route('evento.list');
    }

    public function status(Request $request, string $id)
    {
        $usuario = Auth::user();

        if(!($usuario && Hash::check($request->password, $usuario->password))) {
            $validator = Validator::make([], []);
            $validator->errors()->add('password', 'Senha incorreta. Verifique suas credenciais');
            throw new ValidationException($validator);
        }

        $evento = $this->evento->find($id);
        $status_id = null;

        switch ($request->status_id) {
            case 1: // Ativar

                if(count($evento->inscricoes) < $evento->capacidade && time() < $evento->data_fim)
                    $status_id = 1;
                else {
                    $validator = Validator::make([], []);
                    $validator->errors()->add('status_id', 'Não foi possível ativar o evento. Revise capacidade e período e tente novamente');
                    throw new ValidationException($validator);

                    return redirect()->back();
                }
                break;
            case 2: // Pausar
                $status_id = 2;

                break;
            case 4: // Finalizar
                $status_id = 4;

            break;
            default:

                break;
        }

        if ($status_id > 0) {
            $evento->update([
                'status_id' => $status_id,
            ]);
        }

        return redirect()->route('evento.list');
    }

    public function destroy(string $id)
    {
        // Não haverá deleção de evento
    }
}
