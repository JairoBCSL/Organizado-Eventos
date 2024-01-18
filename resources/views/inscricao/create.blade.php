@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center h-100">
    <nova-inscricao-component csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :user_id='{{ Auth::user()->id }}' :evento_id='{{ $evento_id }}'></nova-inscricao-component>
</div>

@endsection
