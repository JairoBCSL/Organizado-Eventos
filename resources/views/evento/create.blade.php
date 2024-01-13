@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form class="d-flex row justify-content-between align-items-end">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao"></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="local">Local</label>
                                <input type="text" class="form-control" id="local">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="data">Período</label>
                                <input type="text" class="form-control" id="data">
                            </div>

                            <button type="submit" class="btn btn-primary">Criar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
