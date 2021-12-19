@extends("front.layout.app")

@section("content")
{{-- Css --}}
<link rel="stylesheet" href={{asset("/css/front/explorar.css")}}>
<div class="content">
        {{-- Contingut --}}
        <div class="contingut container-fluid  img-responsive container"> </div>
    </div>
    {{-- Scripts --}}
    <script>
        let canReset=false;
        // Document Ready
        $(document).ready(function(){
            // Marcar Navbar
            $(".isSelected").removeClass("isSelected");
            $("#Nav-Recomendados").addClass("isSelected");
            // Carregar contingut
            cargarContenido(0);
            
        });  
        // Funcio carregar contingut
        function cargarContenido(index){
            // Ajax
            $.ajax({
            url: "/recomendados/"+index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            dataType: 'json',
            success: function(data){
                // Ajax correcte
                //Start Foreach   
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
                if(element.majoria_edat==1){
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