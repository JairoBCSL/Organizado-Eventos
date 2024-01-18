@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <grid-inscricao-component :inscricoes='@json($inscricoes)' csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif></grid-inscricao-component>
</div>
@endsection
