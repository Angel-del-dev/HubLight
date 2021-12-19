@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="content" />
<input type="hidden" id="sub" value="typeContent" />
<script src={{asset('js/back/functions.js')}}></script>
<script>
    $(document).ready(function() {
        $('.delete i').on('click',function() {
            let id=$(this).data("id");
            deleteTypeContent(id);
        });

        $('input').on('focusout',function() {
            let element=$(this);
            let campo=element.attr('name');
            let valor=element.val();
            let id=element.closest('tr');
            id=id.data('id');
            editTypeContent(id,campo,valor);
        });
    });
</script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal">
    Nuevo tipo de contenido
</button>
  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="/back/admin/tipuscontent" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="newModalTitle">Nuevo tipo de contenido</h5>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nombre de tipo de contenido" name="tipus" required>
                <br/>
                <input type="text" class="form-control" placeholder="Peso máximo" name="espai" required>
                <br/>
                <input type="text" class="form-control" placeholder="Extensiones: separados porespacio" name="Descripcio" required>
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
            <th>Tipo</th>
            <th>Peso(KB)</th>
            <th>Extensión</th>
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach ($data as $type)
                <tr data-id="{{$type->id}}">
                    <td><input type="number" class="form-control" name="id" value="{{$type->id}}" disabled></td>
                    <td><input type="text" class="form-control" name="tipus" value="{{$type->tipus}}"></td>
                    <td><input type="text" class="form-control" name="espai" value="{{$type->espai}}"></td>
                    <td><input type="text" class="form-control" name="Descripcio" value="{{$type->Descripcio}}"></td>
                    <td class="text-center"><span class="delete"><i class="fas fa-times text-danger" data-id="{{$type->id}}" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
