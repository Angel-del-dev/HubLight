@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="usuario" />
<input type="hidden" id="sub" value="notificacion" />
<script src={{asset('js/back/adminify.js')}}></script>

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Enviar aviso</th>
        </thead>
        <tbody>
            @foreach ($data["users"] as $user)
                <tr data-id="{{$user->id}}">
                    <td><input type="number" class="form-control" name="id" value="{{$user->id}}" disabled></td>
                    <td><input type="text" class="form-control" name="nombre" value="{{$user->name}}" disabled></td>
                    <td class="text-center">
                        <select name="avis" aria-label="Elige un aviso a enviar" class="form-select">
                            <option value="0" selected>Elige un aviso a enviar</option>
                            @foreach ($data["avis"] as $avis)
                                <option value="{{$avis->id}}">{{$avis->explicacio}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-danger text-center">Enviar avisos</button>
</form>
@endsection
