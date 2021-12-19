@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="usuario" />
<input type="hidden" id="pag" value="admin" />
<input type="hidden" id="sub" value="adminify" />
<script src={{asset('js/back/adminify.js')}}></script>

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Admin</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr id="{{$user->id}}">
                    <td><input type="number" class="form-control" name="id" value="{{$user->id}}" disabled></td>
                    <td><input type="text" class="form-control" name="nombre" value="{{$user->name}}" disabled></td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" name="es_admin" value="{{$user->es_admin}}"  data-id="{{$user->id}}" {{($user->es_admin) ? 'checked' : ""}}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
