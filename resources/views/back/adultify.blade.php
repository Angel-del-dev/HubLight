@extends('back.layout.app')

@section('content')
<input type="hidden" id="page" value="content" />
<input type="hidden" id="pag" value="content" />
<input type="hidden" id="sub" value="adultify" />
<script src={{asset('js/back/functions.js')}}></script>
<script>
    $(document).ready(function() {
        $('input:checkbox').on('change',function(e) {
            let id=$(this).attr('data-id');
            let aux=(e.target.checked) ? 1 : 0;
            adultify(id,aux);
        });
    });
</script>



<form action="#" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table id="tableContent" class="table table-fluid">
        <thead>
            <th>Enlace contenido</th>
            <th class="text-warning">+18</th>
        </thead>
        <tbody>
            @foreach ($content as $c)
                <tr id="{{$c->id}}">
                    <td>
                        <a href="{{url('/contingut/'.$c->id)}}" target="_blank">
                            @if ($c->descripcio)
                                {{$c->descripcio}}
                            @else
                                Contenido sin descripción
                            @endif
                        </a>
                    </td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" class="edat" name="major" value="{{$c->majoria_edat}}" id={{$c->id}} data-id="{{$c->id}}" {{($c->majoria_edat) ? 'checked' : ""}}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
