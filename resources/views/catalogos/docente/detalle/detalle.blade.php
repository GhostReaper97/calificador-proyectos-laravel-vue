@extends('template.template')

@section('titulo')
    Detalles Docente
@endsection

@section('contenido')
<detalle-docente id="{{ $id }}"></detalle-docente>
@endsection
