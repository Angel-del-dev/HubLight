@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="content" />
<input type="hidden" id="sub" value="contSup" />
<script>
    $(document).ready(function() {
        $('.delete > i').on('click',function() {
            let id=$(this).attr('data-id');
            quitarContenido(id);
        });
    });
</script>

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Titulo</th>
            <th>Enlace al contenido</th>
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach ($contenido as $c)
                <tr>
                    <td><input type="text" class="form-control" name="titulo" value="{{$c->titulo}}"></td>
                    <td class="text-center"><a href="/contingut/{{$c->id}}" target="_blank">{{$c->titulo}}</a></td>
                    <td class="text-center"><span class="delete"><i class="fas fa-times text-danger" data-id="{{$c->id}}" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
