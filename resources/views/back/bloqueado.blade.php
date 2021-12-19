@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="usuario" />
<input type="hidden" id="pag" value="bloqueado" />
<input type="hidden" id="sub" value="bloquear" />
<script src="{{asset('js/back/adminify.js')}}"></script>

<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Bloqueado</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr id="{{$user->id}}">
                    <td><input type="number" class="form-control" name="id" value="{{$user->id}}" disabled></td>
                    <td><input type="text" class="form-control" name="nombre" value="{{$user->name}}" disabled></td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" name="suspes" value="{{$user->suspes}}"  data-id="{{$user->id}}" {{($user->suspes) ? 'checked' : ""}}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
