@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <p>Panel de Usuarios</p>
    <div class="container mx-auto m-4">
        <x-dash>
            @livewire('client-table')
        </x-dash>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // Swal.fire('Any fool can use a computer')
    </script>
@stop