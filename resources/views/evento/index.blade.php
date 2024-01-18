@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <slideshow-component :eventos='@json($eventos)'></slideshow-component>
    <h3 style="font-family: Montserrat, sans-serif;" class="fw-bold text-danger mt-5 mx-5">Inscrições abertas</h3>
    <carroussel-component :eventos='@json($eventos)'></carroussel-component>
    @guest @else
        <h3 style="font-family: Montserrat, sans-serif;" class="fw-bold text-danger mt-5 mx-5">Perto de Mim</h3>
        <carroussel-component :eventos='@json($eventos)'></carroussel-component>
    @endguest
</div>
@endsection
