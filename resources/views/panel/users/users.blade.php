@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
<x-panel.header class="bg-yellow-500 text-black">Usuarios</x-panel.header>
@stop

@section('content')
    <div class="container mx-auto m-4">
        <x-messages.flash-messages/>

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
        $("#close").hover(function(){
            $("#alert-message").hide();
        });

    </script>
@stop
