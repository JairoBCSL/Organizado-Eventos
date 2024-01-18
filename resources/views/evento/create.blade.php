@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center h-100">
    <novo-evento-component csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :user_id="{{ Auth::user()->id }}" :cidades="{{ $cidades }}"></novo-evento-component>
</div>

@endsection
