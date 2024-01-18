@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center h-100">
    <novo-pagamento-component csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :inscricao='@json($inscricao)'></novo-pagamento-component>
</div>

@endsection
