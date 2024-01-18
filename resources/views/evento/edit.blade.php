@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center h-100">
    <editar-evento-component :evento="{{ $evento }}" :cidades="{{ $cidades }}" csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :user_id="{{ Auth::user()->id }}"></editar-evento-component>
</div>

@endsection
