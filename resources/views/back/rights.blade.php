@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="content" />
<input type="hidden" id="sub" value="rights" />
<script src={{asset('js/back/functions.js')}}></script>
<script>
    $(document).ready(function() {
        $('span i').on('click',function() {
            let id=$(this).data("id");
            deleteRight(id);
        });

        $('input').on('focusout',function() {
            let element=$(this);
            let campo=element.attr('name');
            let valor=element.val();
            let id=element.closest('tr');
            id=id.data('id');
            editRight(id,valor);
        });
    });
</script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal">
    Nuevo derecho de autor
</button>
  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="/back/admin/rights" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="newModalTitle">Registrar derechos de autor</h5>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nombre de derecho de autor" name="tipus" required>
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
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach ($rights as $r)
                <tr data-id="{{$r->id_dret}}">
                    <td><input type="number" class="form-control" name="id" value="{{$r->id_dret}}" disabled></td>
                    <td><input type="text" class="form-control" name="tipus" value="{{$r->tipus}}"></td>
                    <td class="text-center"><span><i class="fas fa-times text-danger" data-id="{{$r->id_dret}}" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
