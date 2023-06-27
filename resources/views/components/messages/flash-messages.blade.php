@if ($message = Session::get("success"))
<div id="alert-message" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-emerald-600">
    {{-- <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-bell" />
    </span> --}}
    <span class="inline-block align-middle mr-8">
      <b class="capitalize">{{$message}}</b>
    </span>
    <button id="close" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
      <span>×</span>
    </button>    
</div>
@endif

@if ($message = Session::get("warning"))
<div id="alert-message" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-amber-500">
    {{-- <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-bell" />
    </span> --}}
    <span class="inline-block align-middle mr-8">
      <b class="capitalize">{{$message}}</b>
    </span>
    <button id="close" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
      <span>×</span>
    </button>
</div>
@endif

@if ($message = Session::get("error"))
<div id="alert-message" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
    {{-- <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-bell" />
    </span> --}}
    <span class="inline-block align-middle mr-8">
      <b class="capitalize">{{$message}}</b>
    </span>
    <button id="close" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
      <span>×</span>
    </button>
</div>
@endif