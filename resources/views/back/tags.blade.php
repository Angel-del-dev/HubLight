@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="tags" />
<input type="hidden" id="sub" value="tag" />
<script src={{asset('js/back/functions.js')}}></script>
<script>
    $(document).ready(function() {
        $('span i').on('click',function() {
            let id=$(this).attr('data-id');
            deleteTag(id)
        });
    });
</script>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal">
    Nuevo Tag
</button>
  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="/back/admin/tags" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="newModalTitle">Nuevo Tag</h5>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nombre del tag" name="nombre" required>
                <br/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" />
              </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End modal --}}

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Id</th>
            <th>Etiqueta</th>
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach ($tags as $t)
                <tr>
                    <td><input type="text" class="form-control" name="nombre" value="{{$t->id}}" disabled></td>
                    <td><input type="text" class="form-control" name="nombre" value="{{$t->nombre}}" disabled></td>
                    <td class="text-center"><span><i class="fas fa-times text-danger" data-id="{{$t->id}}" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
