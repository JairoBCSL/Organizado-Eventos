@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <grid-evento-component :eventos='@json($eventos)' csrf_token="{{ csrf_token() }}" @if($errors->any()) :errors="{{ $errors }}" @endif></grid-evento-component>
</div>
@endsection
