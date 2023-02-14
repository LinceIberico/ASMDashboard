@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container mx-auto p-4">
    <x-dash>
        {{-- @livewire('user-table') --}}
    </x-dash>    
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
    {{-- @powerGridStyles --}}
@stop

@section('js')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
{{-- @powerGridScripts --}}
    <script>
        // Swal.fire('Any fool can use a computer')
    </script>
@stop
