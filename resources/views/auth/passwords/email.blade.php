@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center h-100">
        <email-component csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif ></email-component>
    </div>
@endsection
