@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center h-100" style="margin-top: -24px; margin-bottom: -24px">
        <detalhe-evento-component :evento="{{ $evento }}" csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif :user_id="{{ Auth::user()->id ?? 0 }}"></detalhe-evento-component>
    </div>
@endsection
