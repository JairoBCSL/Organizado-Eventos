@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <manage-grid-component :inscricoes='@json($inscricoes)' :evento='@json($evento)' csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif></manage-grid-component>
</div>
@endsection
