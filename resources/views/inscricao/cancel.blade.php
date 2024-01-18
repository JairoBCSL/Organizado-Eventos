@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center h-100">
    <cancelar-inscricao-component csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :inscricao_id='{{ $inscricao_id }}'></cancelar-inscricao-component>
</div>

@endsection
