@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="usuario" />
<input type="hidden" id="sub" value="lista" />
<script>
    $(document).ready(function() {
        $('.delete > i').on('click',function() {
            let id=$(this).attr('data-id');
            quitarAvisos(id);
        });

        $('.accept > i').on('click',function() {
            let id=$(this).attr('data-id');
            aceptarAviso(id);
        });
    });
</script>

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Usuario</th>
            <th>Explicación</th>
            <th>Enlace a perfil</th>
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach ($avis as $a)
                <tr>
                    <td><input type="text" class="form-control" name="nombre" value="{{$a->name}}"></td>
                    <td><input type="text" class="form-control" name="nombre" value="{{$a->explicacio}}" disabled></td>
                    <td class="text-center"><a href="{{url('/usuaris/'.$a->idUser)}}">Perfil de usuario</a></td>
                    <td class="text-center">
                        <span class="delete">
                            <i class="fas fa-times text-danger" data-id="{{$a->id}}" data-toggle="tooltip" data-placement="top" title="Eliminar"></i>
                        </span>
                        <span class="accept">
                            <i class="fas fa-check text-success" data-id="{{$a->id}}" data-toggle="tooltip" data-placement="top" title="Aceptar"></i>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
