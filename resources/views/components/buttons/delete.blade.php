@props(['type' => 'submit', 'route' => "", 'user' => ''])

{{-- <form onsubmit="return confirm('¿Está seguro de eliminar el registro?')" action="{{route('user.delete',$user)}}" method="POST"> --}}
<form action="{{route('user.delete',$user)}}" method="POST">

@csrf
@method('delete')
{{-- <input type="hidden" name="id" value="delete"> --}}
<button  type="{{$type}}" {{ $attributes->merge(['class' => 'rounded-lg p-2 bg-red-600 hover:bg-red-700 text-white text-bold uppercase deleteConfirmation'])}} >
    <span class="px-0">
        <i class="fas fa-check">Eliminar</i>
      </span>

      {{ $slot }}

</button>
</form>
<script>
  
$(".deleteConfirmation").click(deleteConfirmation);
  
function deleteConfirmation() {
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $(this).parent('form').trigger('submit')
  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
});
}
  

</script>