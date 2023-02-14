@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
<x-panel.header class="bg-yellow-500 text-black">Usuarios</x-panel.header>
@stop

@section('content')
    <div class="container mx-auto m-4">
        <x-dash>
            @livewire('user-table')
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
