@extends("front.layout.app")
{{-- Css --}}
<link rel="stylesheet" href={{asset("/css/front/contingut.css")}}>
@section("content")
<div class="content">
    {{-- Header --}}
    <div class="header-contingut">
        {{-- Usuari --}}
        <a href="{{asset('/usuaris/'.$results->id_user)}}">
            <div>
                <img src={{asset("images/perfil/usuarios/".$results->foto_perfil)}} class="header-perfil-img" title="Perfil">
            </div>
        </a>
        <h2>{{$results->titulo}}</h2>
    </div>
    {{-- Contingut --}}
    @if ($results->tipus_contingut==1)
        {{-- Contingut Imatge --}}
        <div class="contingut-principal bg-image" style="background-image:url({{asset('/contenido/1/'.$results->url)}});">
            <img class="img-fluid" src="{{asset('/contenido/1/'.$results->url)}}">
        </div>
    @else
        {{-- Contingut Video --}}
        @if ($results->tipus_contingut==4)
            <div class="contingut-principal" style="background-image:url({{asset('/contenido/1/'.$results->portada)}});">
                <video controls="controls" style="cursor: pointer;" src={{asset('/contenido/4/'.$results->url)}} data-toggle="tooltip" data-placement="right" class="embed-responsive-item"></video>
            </div>
        @endif
        {{-- Contingut Musica --}}
        @if ($results->tipus_contingut==3)
            <div class="contingut-principal" style="background-image:url({{asset('/contenido/1/'.$results->portada)}});">
                <audio controls="controls" style="cursor: pointer;" src={{asset('/contenido/3/'.$results->url)}} data-toggle="tooltip" data-placement="right" class="music-arxiu"></audio>
            </div>
        @endif

        @if ($results->tipus_contingut==2||$results->tipus_contingut==5)
            <div class="contingut-principal" style="background-image:url({{asset('/contenido/1/'.$results->portada)}});">
                @if ($results->titulo!=null&&$results->titulo!="")
                <a type="button" href="{{asset('/contenido/'.$results->tipus_contingut.'/'.$results->url)}}" download="{{$results->titulo}}" class="btn btn-success download">Descargar contenido</a>
                @else
                <a type="button" href="{{asset('/contenido/'.$results->tipus_contingut.'/'.$results->url)}}" download="{{$results->url}}" class="btn btn-success download">Descargar contenido</a>
                @endif
            </div>
        @endif
    @endif
    {{-- Footer --}}
    <div class="footer-contingut">
        {{-- Header-Footer --}}
        @if (isset(Auth::user()->id))
        <div class="header-footer-contingut">
            <div>
                @if (Auth::user()->id!=$results->id_user)
                    @if ($like=="1")
                        <i class="fa pe-7s-like megusta" id="like" data-toggle="Me gusta"> </i>
                    @else
                        <i class="fa pe-7s-like" id="like" data-toggle="Me gusta"></i>
                    @endif  
                    <i class="fa pe-7s-attention" id="report" data-toggle="Reportar contenido" style="float: right;"> </i>
                    
                    
                @endif              
                <i class="fa pe-7s-paper-plane" id="enviar" data-toggle="Enviar"> </i>
                <span class="span-envia-cont">
                    <select class="enviaCont" multiple="multiple"></select>
                    <button type="button" class="btn btn-success button-envCont" value="{{$results->id}}">Enviar</button>
                </span>
                <span class="span-envia-report">
                    <select class="envia-report"></select>
                    <button type="button" class="btn btn-success button-envRep" value="{{$results->id_user}}">Enviar</button>
                </span>
            </div>
        </div>
        @endif
        {{-- Content-Footer --}}
        <div class="border-bot">            
            <div>
                <span>{{$q_likes}} likes</span> 
                <span class="fecha-contingut">{{date("d/m/Y",strtotime($results->created_at))}}</span>
                <p class="descripcio">{{$results->descripcio}}</p>                              
            </div>           
            @foreach ($comentarios as $item)
                @if ($item->comentario!=null||$item->comentario!="")
                    <div class="comentario">
                        <span class="fecha-contingut" style="float: right;">{{date("d/m/Y",strtotime($item->created_at))}}</span>
                        <a href="{{asset('/usuaris/'.$item->id_usuari)}}">
                            <img class="foto-coment" src={{asset("images/perfil/usuarios/".$item->foto)}}>
                        </a>
                        <p class="text-comment">{{$item->comentario}}</p>
                        
                    </div>
                @endif            
            @endforeach
        </div>
        {{-- Footer-Footer --}}
        <div >
            @if (isset(Auth::user()->id))
                @if (Auth::user()->id!=$results->id_user)
                <form id="comentari">
                    <div class="form-group">
                        <img src={{asset("images/perfil/usuarios/".Auth::user()->foto)}} class="foto-coment">
                        <input type="checkbox" value="{{$like}}" {{($like=="1") ? 'checked' : ""}} hidden name="megusta" id="megusta">
                        <input type="hidden" name="id_contingut" value="{{$results->id}}" />
                        <textarea class="form-control" rows="4" name="comentario" id="mensaje"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit-comment">Envia</button>
                </form>
                @endif
            @endif
        </div>
    </div>

</div>
{{-- Scripts --}}
<script>
    // Document Ready
    $(document).ready(function(){
        // Marcar Navbar
        $(".isSelected").removeClass("isSelected");
        var megusta=$("#megusta").val();
        $(document).on("submit",function(e){
            e.preventDefault();
            enviaComent();
        });
        $("#like").on("click",function(e){

            if($("#megusta").prop("checked")){
                $("#megusta").prop("checked",false);
                $("#like").removeClass("megusta");
            }else{
                $("#megusta").prop("checked",true);
                $("#like").addClass("megusta");
            }
            enviaLike();
            
        });
        $(".span-envia-cont").hide();
        $(".span-envia-report").hide();
        $("#enviar").on("click",function(){
            $(this).parent().find(".span-envia-cont").fadeIn();
            $(".span-envia-report").fadeOut();
        });
        $("#report").on("click",function(){
          $(this).parent().find(".span-envia-report").fadeIn();
          $(".span-envia-cont").fadeOut();
        });
        $("body").append($("<input>").attr("id","loader").hide());
        rebreChats();
        getReports();
    });

    function enviaComent(){
        var comentario=$("#mensaje").val();
        var idProp={{$results->id_user}};
        $.ajax({
        url: "/comment",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_contingut":{{$results->id}},
            "comentario":comentario,
            "idProp":idProp
        },
        success: function(data){
        }
        });
    }

    function enviaLike(){
        var megusta="0";
        
        if($("#megusta").prop("checked")){
            megusta="1";
        }
        var idcont={{$results->id}};
        var idProp={{$results->id_user}};
        $.ajax({
        url: "/comment",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_contingut":{{$results->id}},
            "megusta":megusta,
            "idProp":idProp
        },
        success: function(data){
        },error: function(data){
        }
        });
    }

    //id_contenido
    //megusta
    //comentario
</script>
@endsection
