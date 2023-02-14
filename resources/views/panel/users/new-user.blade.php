@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
    <x-panel.header class="bg-yellow-500 text-black">Nuevo Usuario</x-panel.header>
@stop

@section('content')
    <div class="container mx-auto m-4">
        <x-dash>
            <x-form-base>
                <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Nombre Usuario
                    </span>
                    <input type="name" name="name" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:lgfocus:ring-1" placeholder="username" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Email
                    </span>
                    <input type="email" name="email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="ejemplo@gmail.com" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Contraseña
                    </span>
                    <input type="password" name="password_1" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Repetir Contraseña
                    </span>
                    <input type="password" name="password_2" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Elige Rol
                    </span>
                    <input type="text" name="rol" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>
                  </label>
            </x-form-base>
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