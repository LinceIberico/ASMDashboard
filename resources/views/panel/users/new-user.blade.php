@extends('adminlte::page')

@section('title', 'dashboard')

@section('content_header')
    <x-panel.header class="bg-yellow-500 text-black">Nuevo Usuario</x-panel.header>
@stop

@section('content')
    <div class="container mx-auto m-4">
        <x-dash>

            
            <x-form-base id="form_new_user" action="{{route('user.store')}}" method="POST">
                @csrf
                @method('post')
                
                <x-messages.flash-messages/>
                @if($errors->any())
                <p>Hubo un error</p>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>    
                @endforeach
                @endif
                <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Nombre Usuario
                    </span>
                    <input type="text" name="name" class="lg:text-lg md:text-base mt-1 px-3 py-2 bg-white border-2 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:lgfocus:ring-1" placeholder="username" />
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Email
                    </span>
                    <input type="email" name="email" class="lg:text-lg md:text-base mt-1 px-3 py-2 bg-white border-2 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="ejemplo@gmail.com" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Contraseña
                    </span>
                    <input type="password" name="password_1" class="lg:text-lg md:text-base mt-1 px-3 py-2 bg-white border-2 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Repetir Contraseña
                    </span>
                    <input type="password" name="password_2" class="lg:text-lg md:text-base mt-1 px-3 py-2 bg-white border-2 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                  </label>
                  <label class="block">
                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-medium text-slate-700">
                      Elige Rol
                    </span>
                    <select id="rol" name="rol" class="lg:text-lg md:text-base mt-1 px-3 py-2 bg-white border-2 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-base focus:ring-1">

                        @foreach ($roles as $rol)
                        {{-- {{print_r($rol)}} --}}
                            <option class="lg:text-lg md:text-base" value="{{$rol->name}}">{{$rol->name}}</option>
                        @endforeach

                    </select>
                  </label>
                  <div class="flex justify-center p-2">
                    <div class="px-2">
                        <x-buttons.accept id="btnCrear">Crear</x-buttons.accept>
                    </div>
                    <div class="px-2">
                        <x-buttons.back route="user.index">Volver</x-buttons.back>
                    </div>
                  </div>

            </x-form-base>
        </x-dash>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> --}}

    <script>
$("#btnCrear").click(validar);

$("#close").hover(function(){
    $("#alert-message").hide();
});

function validar(evento) {
    evento.preventDefault();
    
    let bValidarFormulario = true;

    var errorNombre = "";
    var errorEmail = "";
    var errorPassword = "";
    var errorPassword2 = "";

    let oExpRegEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let oExpRegPassword = /^[0-9]{8}$/;

    let name = form_new_user.name.value.trim();
    let email = form_new_user.email.value.trim();
    let password_1 = form_new_user.password_1.value.trim();
    let password_2 = form_new_user.password_2.value.trim();

    if (name.length == 0) {
        if (bValidarFormulario) {
            bValidarFormulario = false;
            form_new_user.name.focus();
        }

        errorNombre = "<span style='color: red' <i class='fas fa-exclamation'></i></span> Falta el nombre.";
        form_new_user.name.classList.add("border-rose-600");

    } else {

        // form_new_user.name.classList.remove("border-rose-600");
        form_new_user.name.classList.add("border-emerald-600");
    }

    if (!oExpRegEmail.test(email)) {
        if (bValidarFormulario) {
            form_new_user.email.focus();
            bValidarFormulario = false;
        }
        errorEmail = "<span style='color: red' <i class='fas fa-exclamation'></i></span> El email está vacío o con errores.";
        form_new_user.email.classList.add("border-rose-600");

    } else {
        // form_new_user.email.classList.remove("border-rose-600");
        form_new_user.email.classList.add("border-emerald-600");
    }

    if (password_1.length == 0) {
        if (bValidarFormulario) {
            form_new_user.password_1.focus();
            bValidarFormulario = false;
        }
        errorPassword = "<span style='color: red' <i class='fas fa-exclamation'></i></span> Contraseña incorrecta.";
        form_new_user.password_1.classList.add("border-rose-600");

    } else {
        // form_new_user.password_1.classList.remove("border-rose-600");
        form_new_user.password_1.classList.add("border-emerald-600");
    }

    if (password_2.length == 0 || password_1 != password_2) {
        if (bValidarFormulario) {
            form_new_user.password_2.focus();
            bValidarFormulario = false;
        }
        errorPassword2 = "<span style='color: red' <i class='fas fa-exclamation'></i></span>La contraseña no coincide.";
        form_new_user.password_2.classList.add("border-rose-600");

    } else {
        form_new_user.password_2.classList.add("border-emerald-600");
    }

    // COMPROBACIÓN FINAL
    if (bValidarFormulario) { // Si todo OK

        swal.fire({
            text: 'Datos Correctos',
            icon: 'success',
            //confirmButtonText: "Aceptar",
            //timer: 5000,
            buttons: {
                confirm: { text: 'OK' },
            },
        });
        // setTimeout(function() { form_new_user.submit() }, 1500);
        form_new_user.submit();


    } else {
        swal.fire({
            html: '<p>' + errorNombre + "</p>" +
                '<p>' + errorEmail + "</p>" +
                '<p>' + errorPassword + "</p>" +
                '<p>' + errorPassword2 + "</p>",
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#247ef2',
          }).then((result) => {
            if (result.value) {
              if(name.length == 0)
              form_new_user.name.classList.remove("border-emerald-600");
              if(!oExpRegEmail.test(email))
              form_new_user.email.classList.remove("border-emerald-600");
              if(password_1.length == 0)
              form_new_user.password_1.classList.remove("border-emerald-600");
              if(password_2.length == 0)
              form_new_user.password_2.classList.remove("border-emerald-600");
            }
            return false;
          
        });
    }

}
    </script>
@stop