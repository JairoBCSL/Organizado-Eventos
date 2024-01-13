@extends('layouts.app')

@section('content')
<style>

</style>
<div class="container-fluid">
    <slideshow-component :eventos='@json($eventos)'></slideshow-component>
    <h3 style="font-family: Montserrat, sans-serif;" class="fw-bold text-danger mt-5 mx-5">Inscrições abertas</h3>
    <carroussel-component :eventos='@json($eventos)'></carroussel-component>
    <h3 style="font-family: Montserrat, sans-serif;" class="fw-bold text-danger mt-5 mx-5">Perto de Mim</h3>
    <carroussel-component :eventos='@json($eventos)'></carroussel-component>
</div>
@endsection
