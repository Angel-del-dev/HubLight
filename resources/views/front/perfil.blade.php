@extends("front.layout.app")

@section("content")
{{-- Css --}}
<link rel="stylesheet" href={{asset("/css/front/perfil.css")}}>
<link rel="stylesheet" href={{asset("/css/front/explorar.css")}}>
<div class="content">
    <div class="row">
        {{-- Carta de perfil --}}
        <div class="card hovercard">
            {{-- Fondo --}}
            <div class="cardheader" style="background-image: url({{asset('images/perfil/usuarios/fondo/'.$user->fondo)}});"> </div>
                {{-- Foto Perfil --}}
                <div class="avatar">
                    <label>
                        <div class="upload-icon">
                            <img src="{{asset('images/perfil/usuarios/'.$user->foto)}}" alt="Foto de perfil" data-toggle="tooltip" data-placement="right" title="Haz clic para cambiar la foto de perfil" class="foto-perfil">
                        </div>
                    </label>
                </div>
                {{-- Seguir --}}
                @if (isset(Auth::user()->id))
                    @if (Auth::user()->id != $user->id)
                        @if ($seguit==0)
                            <button class="button-seguir btn btn-primary" id="seguir_boton">Seguir</button>
                        @endif
                    @endif
                @endif
                {{-- Activitat Usuari --}}
                @if ($user->actiu==1)
                    <div class="conectado active"></div>
                @else
                    <div class="conectado"></div>
                @endif
                {{-- Estat Usuari --}}
                @if ($user->deshabilitat==1 || $user->suspes==1)
                    <div class="estado" style="background-color: rgb(255, 158, 158)"><i class="pe-7s-attention"></i></div>
                @else
                    @if (!empty($user->email_verified_at))
                        <div class="estado" style="background-color: #a0c8fd"><i class="pe-7s-like2"></i></div>
                    @else
                        <div class="estado"></div>
                    @endif
                @endif
                {{-- Info Usuari --}}
                <div class="info">
                    {{-- Nom --}}
                    <div class="title">
                        <h1>{{$user->name}}</h1>
                    </div>
                    {{-- Alies --}}
                    <div class="desc" id="Alias-Input">Alias: <span>{{$user->alies}}<span></div>
                    {{-- Data Naixament --}}    
                    <div class="desc" title="Fecha Nacimiento"><i class="pe-7s-gift"></i>{{date("d/m/Y",strtotime($user->data_naixement))}}</div>
                    {{-- Creacio Compta --}}
                    <div class="desc" title="Fecha Creacion Usuario"><i class="pe-7s-stopwatch"></i>{{$user->created_at->diffForHumans()}}</div>
                </div> 
                <div class="contingut container-fluid  img-responsive container"> </div> 
            </div>            
        </div>
    </div>
</div>
{{-- Scripts --}}
<script>
    let canReset=false;
    // Document Ready
    $(document).ready(function(){
        // Marcar Navbar
        $(".isSelected").removeClass("isSelected");
        $("#Nav-Perfil").addClass("isSelected");
        $("#seguir_boton").on("click",function(){
            seguir();
        });
        cargarContenido(0);
    });   
    // Seguir usuari
    function seguir(){
        $("#seguir_boton").hide();
        $.ajax({
        url: "/usuaris/add/friend",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "seguit":{{$user->id}}
        },
        success: function(data){
        }
        });
    }
    
    function aceptar(){
        $.ajax({
        url: "/usuaris/add/friend",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "PUT",
        data: {
            id:1,
            "acceptat":1
        },
        success: function(data){
        }
        });
    }

    // Funcio carregar contingut
    function cargarContenido(index){
            // Ajax
            let AUTH=JSON.parse($("#Auth").val());
            $.ajax({
            url: "/usuarispubli/{{$user->id}}/"+index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            dataType: 'json',
            success: function(data){
                // Ajax correcte
                //Start Foreach    
                data=data.sort(function (a, b) {
                return (b.id - a.id)
                });
              $.each(data, function(index,element){
                // Creacio de objecte i classes
                let object=$("<a>");
                object.addClass("publicacio");
                object.attr("href","/contingut/"+element.id);
                let img=$("<img>");
                img.addClass("image-thumbnail");
                let icon=$("<i>");
                icon.addClass("fas");
                // Asignacio imatge
                if(element.tipus_contingut==1){
                    img.attr("src",'{{asset("contenido/1")}}/'+element.url);
                }else{
                    img.attr("src",'{{asset("contenido/1")}}/'+element.portada);
                }
                if(element.majoria_edat==1&&AUTH.id!={{$user->id}}){
                img.css({
   'filter'         : 'blur(30px)',
   '-webkit-filter' : 'blur(30px)',
   '-moz-filter'    : 'blur(30px)',
   '-o-filter'      : 'blur(30px)',
   '-ms-filter'     : 'blur(30px)'
});
            } 
                // Icona del contingut
                switch(element.tipus_contingut){
                    case  1:
                    icon.append($("<img>").attr("src",'{{asset("iconos/img.svg")}}'));
                    break;
                    case 2:
                    icon.append($("<img>").attr("src",'{{asset("iconos/text.svg")}}'));
                    break;
                    case 3:
                    icon.append($("<img>").attr("src",'{{asset("iconos/music.svg")}}'));
                    break;
                    case 4:
                    icon.append($("<img>").attr("src",'{{asset("iconos/video.svg")}}'));
                    break;
                    case 5:
                    icon.append($("<img>").attr("src",'{{asset("iconos/otros.svg")}}'));
                    break;
                }
                object.append(icon);
                object.append(img);
                $(".contingut").append(object);
              }); 
              // End Foreach       
              rebreChats();
              canReset=true;
              if(index==0){
                $(window).on("scroll", function() {
                    if(canReset){
                        // console.log($(".contingut").height()+"/"+($(window).height()+$(window).scrollTop()));
                        if($(".contingut").height()<($(window).height()+$(window).scrollTop())){
                            // console.log(":)");
                            canReset=false;
                            index++;
                            cargarContenido(index);
                        }
                    }
                });
              }
            }

            });
        }
    
</script>
@endsection
