{{-- Css --}}
<link rel="stylesheet" href={{asset("/css/front/chat.css")}}>
{{-- Modal --}}
<div class="modal fade" id="ChatModal" tabindex="-1" role="dialog" aria-labelledby="ChatModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="xats-disp">
        <div class="card-header">Chat 
          <button type="button" class="btn btn-secondary closeButon chat-close" data-dismiss="modal" form="formModal"><i class="fa pe-7s-close"></i></button>
          <i class="fa pe-7s-angle-up showChat" id="iconDown" title="Ver Chat" style="color: black"> </i>
        </div>
        <div class="row addChat">
          
          <div class="chat-msg">
            Agrega un nuevo chat
          </div>
          <div class="chat-msg-noF">
            No tienes amigos con quien chatear
          </div>
            
            <div class="Agrega">
              <select id="nouChat" multiple="multiple"></select>
              <i class="fa pe-7s-plus nouChatButton" title="Añadir Chat"> </i>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
          <div class="card">
            <div class="card-header"> 
              <button type="button" class="btn btn-secondary closeButon chat-close" data-dismiss="modal" form="formModal"><i class="fa pe-7s-close"></i></button>
              <div class="div-nouUser d-flex">
                <h6>Chat</h6>
                <i class="fa pe-7s-angle-down showChat" title="Ver Chat"> </i>
              </div>
            </div>
              <div class="card-body height3 chat-container">
                <ul class="chat-list">                                  
                </ul>
              </div>
              <div class="card-header d-flex">
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 p-0">
                  <textarea class="inputMsg" name="newMsg" maxlength="200" id="newMsg" rows="10"></textarea>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 p-0 d-flex">
                  <button type="button" class="btn btn-primary butonSendMSG" form="formModal">Subir</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Scripts --}}
<script>
  // Variables Globals
  let AUTH=JSON.parse($("#Auth").val());
  let idChat;
  let interval=null;
  let chatActive=false;
  let indexChat=0;
  // Document Ready
  $(document).ready(function(){
    $("#iconDown").hide();
    
    $(".showChat").on("click",function(){
      $(".xats-disp").slideToggle();
    });
    $(".butonSendMSG").on("click",function(){
      enviaMSG();
    });
    
    // Control actualitzar xat
    $(".chat-close, .enable-chat-modal").on("click",function(){
      if(chatActive){
        if(interval!=null){
          clearInterval(interval);
          interval=null;
        }
        chatActive=false;
      }else{
        if(idChat!=null){
          interval=setInterval(function(){
          rebreLast(idChat);
        }, 5000);
        chatActive=true;
        }
      }
    });

    $(".nouChatButton").on("click",function(){
      creaChat();
    });
    //Missatges anteriors
    $(".chat-container").on("scroll", function() {
      if($(".chat-container").scrollTop()==0){
        $(".fechaChat:first-of-type").remove();
        indexChat++;
        CarregaMissatgesAnteriors(idChat,indexChat)
      }      
    });
  });
  // Rebre els xats
  function rebreChats(){
    let AUTH=JSON.parse($("#Auth").val());
    $.ajax({
        url: "/chats",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        dataType: 'json',
        success: function(data){  
          //Chats                 
          $(".xats-disp").find(".selectChat").remove();
          // Start Foreach
          $.each(data, function(index,element){
            let integrantes=[];
            $.each(element.integrantes, function(i,el){
              if(el.id_usuari!=element.id_usuari){
                integrantes.push(el.foto);
              }
            });
            let contenidor=$("<div>");
            contenidor.addClass("row");
            contenidor.addClass("addChat");
            contenidor.addClass("selectChat");
            contenidor.attr("chat-val",element.id_xat);
            let chatImg=$("<div>");
            chatImg.addClass("foto-Chats");
            let fotoChat=$("<img>");
            let nomChat=$("<p>");
            nomChat.addClass("chat-msg");
            let lastMensage=$("<p>");
              let iconMSG=$("<i>");
            iconMSG.addClass("pe-7s-chat");
            iconMSG.addClass("fa");
            iconMSG.addClass("iconMSG");
            lastMensage.append(iconMSG);
            if(element.last_message!=null){
              lastMensage.append($("<span>").text(element.last_message.missatge));
            }
            lastMensage.addClass("chat-msg");
            let nom=element.nom_xat;
            if(element.nom_xat==""||element.nom_xat==null||element.nom_xat==undefined){          
              $.each(element.integrantes, function(i,el){
                if(el.id_usuari!=element.id_usuari){
                  nom+=el.name+" ";
                }
              });
            }
            nomChat.text(nom);
            let random=Math.floor(Math.random() * integrantes.length); 
            fotoChat.attr("src","{{asset('images/perfil/usuarios/')}}/"+integrantes[random]);
            chatImg.append(fotoChat);
            contenidor.append(chatImg);
            contenidor.append(nomChat);
            contenidor.append(lastMensage);
            $(".xats-disp").append(contenidor);

            $(".enviaCont").append($("<option>").val(element.id_xat).text(nom));
          });
          // End Foreach
          meterAmigos();
          $(".selectChat").on("click",function(){
            idChat=$(this).attr("chat-val");
            rebreMissatges(idChat,0);
          });
          $('.enviaCont').multiselect({
            includeSelectAllOption: true,
          });
          $(".button-envCont").off("click");
          $(".button-envCont").on("click",function(){
            let idCont=$(this).val();
            let xats=$(this).parent().find(".enviaCont").val();
            comparteixCont(idCont,xats);
          });
        }
    });
  }
  // Rebre els missatges, per primer pic
  function rebreMissatges(idChat,index){
    $.ajax({
        url: "/chats/missatges/anterior",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_xat":idChat,
            "index":index
        },
        dataType: 'json',
        success: function(data){ 
          //Mensages  
          data=data.sort(function (a, b) {
          return (a.id - b.id)
        });                
          if(interval!=null){
            clearInterval(interval);
            interval=null;
          }
          $(".chat-list li").remove();
          let uFecha="";
          let fechaHoy=new Date();
          // Start Foreach
          $.each(data, function(index,element){
            let fecha=new Date(element.created_at);
            if(uFecha!=(fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())){
              let liFecha=$("<li>");
              if((fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())==(fechaHoy.getDate()+"/"+(fechaHoy.getMonth()+1)+"/"+fechaHoy.getFullYear())){
                liFecha.text("Hoy");
              }else {
                let fechaAyer="";
                if(fechaHoy.getDate()-1!=0){
                  fechaAyer=(fechaHoy.getDate()-1)+"/"+(fechaHoy.getMonth()+1)+"/"+fechaHoy.getFullYear();
                }else if(fechaHoy.getMonth()!=0){
                  fechaAyer=fechaHoy.getDate()+"/"+fechaHoy.getMonth()+"/"+fechaHoy.getFullYear();
                }else{
                  fechaAyer=fechaHoy.getDate()+"/"+fechaHoy.getMonth()+"/"+(fechaHoy.getFullYear()-1);
                }
                if((fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())==fechaAyer){
                  liFecha.text("Ayer");
                }else{
                  liFecha.text(fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear());
                }
              }
              liFecha.css("color","black");
              liFecha.css("text-align","center");
              liFecha.addClass("fechaChat");
              uFecha=fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
              $(".chat-list").append(liFecha);
            }
            let li=$("<li>");
            if(element.id_usuari==AUTH.id){
              li.addClass("out");
            }else{
              li.addClass("in");
            }
            let chatImg=$("<div>");
            chatImg.addClass("chat-img");
            let imgPerf=$("<img>");
            imgPerf.attr("alt","Avtar");
            imgPerf.attr("src","{{asset('images/perfil/usuarios/')}}/"+element.foto);
            chatImg.append(imgPerf);
            let chatBody=$("<div>");
            chatBody.addClass("chat-body");
            let chatMessage=$("<div>");
            chatMessage.addClass("chat-message");
            let name=$("<h5>");
            name.text(element.name);
            let msg=$("<p>");
            msg.text(element.missatge);
            let hora=$("<p>");
            let minuto=fecha.getMinutes();
            if(minuto<10){
              minuto="0"+minuto;
            }
            hora.text(fecha.getHours()+":"+minuto);
            chatMessage.append(name);
            chatMessage.append(msg);
            if(element.id_contingut!=null){
              let aCont=$("<a>");
              aCont.attr("href","{{asset('contingut/')}}"+"/"+element.id_contingut);
              aCont.addClass("msgContingut");
              let imgCon=$("<img>");
              if(element.contingut.tipus_contingut==1){
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.url);
              }else{
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.portada);
              }
              if(element.contingut.majoria_edat==1){
                imgCon.css({
   'filter'         : 'blur(30px)',
   '-webkit-filter' : 'blur(30px)',
   '-moz-filter'    : 'blur(30px)',
   '-o-filter'      : 'blur(30px)',
   '-ms-filter'     : 'blur(30px)'
});
            }  
              aCont.append(imgCon);
              chatMessage.append(aCont);
            }
            chatMessage.append(hora);  
            chatBody.append(chatMessage); 
            li.append(chatImg);
            li.append(chatBody);            
            $(".chat-list").append(li);
          });
          // End Foreach
          meterAmigosChat();
          rebreLast(idChat,true);
          $(".xats-disp").slideUp(); 
          $("#iconDown").show();
          interval=setInterval(function(){
            rebreLast(idChat);
          }, 5000);
          chatActive=true;
          $('.card-body').scrollTop($('.card-body')[0].scrollHeight);
          indexChat=0;
        }
    });
  }

  // rebre els missatges, que no ha vist l'usuari
  function rebreLast(idChat,isFirst=false){
    $.ajax({
        url: "/chats/missatges/"+idChat,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        dataType: 'json',
        success: function(data){   
          //Mensages
          data=data.sort(function (a, b) {
          return (a.id - b.id)
        });                
          // Start foreach
          $.each(data, function(index,element){
            let fecha=new Date(element.created_at);
            let li=$("<li>");
            if(element.id_usuari==AUTH.id){
              li.addClass("out");
            }else{
              li.addClass("in");
            }
            let chatImg=$("<div>");
            chatImg.addClass("chat-img");
            let imgPerf=$("<img>");
            imgPerf.attr("alt","Avtar");
            imgPerf.attr("src","{{asset('images/perfil/usuarios/')}}/"+element.foto);
            chatImg.append(imgPerf);
            let chatBody=$("<div>");
            chatBody.addClass("chat-body");
            let chatMessage=$("<div>");
            chatMessage.addClass("chat-message");
            let name=$("<h5>");
            name.text(element.name);
            let msg=$("<p>");
            msg.text(element.missatge);
            let hora=$("<span>");
            hora.text(fecha.getHours()+":"+fecha.getMinutes());
            chatMessage.append(name);
            chatMessage.append(msg);
            if(element.id_contingut!=null){
              let aCont=$("<a>");
              aCont.attr("href","{{asset('contingut/')}}"+"/"+element.id_contingut);
              aCont.addClass("msgContingut");
              let imgCon=$("<img>");
              if(element.contingut.tipus_contingut==1){
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.url);
              }else{
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.portada);
              }
              if(element.contingut.majoria_edat==1){
                imgCon.css({
   'filter'         : 'blur(30px)',
   '-webkit-filter' : 'blur(30px)',
   '-moz-filter'    : 'blur(30px)',
   '-o-filter'      : 'blur(30px)',
   '-ms-filter'     : 'blur(30px)'
});
            }  
              aCont.append(imgCon);
              chatMessage.append(aCont);
            }
            chatMessage.append(hora);  
            chatBody.append(chatMessage); 
            li.append(chatImg);
            li.append(chatBody);            
            $(".chat-list").append(li);
          });
          // End foreach
          if(data.length>0||isFirst){
            $('.card-body').scrollTop($('.card-body')[0].scrollHeight);
          }
        }
    });
  }
  // Enviar missatge
  function enviaMSG(){
    let missatge=$("#newMsg").val();
    $.ajax({
        url: "/chats/missatges",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "missatge":missatge,
            "id_xat":idChat
        },
        success: function(data){
           missatge=$("#newMsg").val("");
           rebreLast(idChat);
        },error: function(data){
        }
      });
  }
  // Crear un xat nou
  function creaChat(){
    let users= $("#nouChat").val();
    users.push(""+AUTH.id);
    if(users.length>1){
      $.ajax({
        url: "/chats/create",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "users":users,
            "nom":null
        },
        success: function(data){
           rebreChats();
        },error: function(data){
        }
      });
    }else{
      alert("Por favor, inserte minimo un usuario");
    }
  }
  // Añadir al select de chats los amigos que puedes añadir
  function meterAmigos(){
    $.ajax({
        url: "/chats/users/amigos",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        success: function(data){
           $.each(data, function(index,element){
            let option=$("<option>");
            option.val(element.id_user);
            option.text(element.name);
            $("#nouChat").append(option);
           });

           $('#nouChat').multiselect({
          includeSelectAllOption: true,
        });
        if(data.length==0){
          $(".Agrega").hide();
          $(".chat-msg").hide();
          $(".chat-msg-noF").show();
        }else{
          $(".Agrega").show();
          $(".chat-msg").show();
          $(".chat-msg-noF").hide();
        }
        },error: function(data){
        }
      });
  }
  // Añadir al select del chat
  function meterAmigosChat(){
    $.ajax({
        url: "/chats/users/amigos/"+idChat,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        success: function(data){
          $(".button-add-new-user").remove();
          $("#addUsers").parent().find(".btn-group").remove();
          $("#addUsers").remove();
          let select=$("<select>");
          select.attr("id","addUsers");
          select.attr("multiple","multiple");
          let butonAddUser=$("<i>");
          butonAddUser.addClass("fa");
          butonAddUser.addClass("pe-7s-add-user");
          butonAddUser.addClass("button-add-new-user");
          butonAddUser.attr("title","Añadir Usuario");
          $(".div-nouUser").append(select);
          $(".div-nouUser").append(butonAddUser);
           $.each(data, function(index,element){
            let option=$("<option>");
            option.val(element.id_user);
            option.text(element.name);
            $("#addUsers").append(option);
           });

           $('#addUsers').multiselect({
          includeSelectAllOption: true,
        });
        $(".button-add-new-user").on("click",function(){
            añadirAmigosChat();
          });
        },error: function(data){
        }
      });
  }
  // Afegir usuaris a un xat que ja existeix
  function añadirAmigosChat(){
    let usuari=$("#addUsers").val()
    $.ajax({
        url: "/chats/users/amigos",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_xat":idChat,
            "users":usuari
        },
        success: function(data){
           $.each(data, function(index,element){
            let option=$("<option>");
            option.val(element.id_user);
            option.text(element.name);
            $("#addUsers").append(option);
           });

           $('#addUsers').multiselect({
          includeSelectAllOption: true,
        });
        },error: function(data){
        }
      });
  }
  // Compartir Contingut
  function comparteixCont(idCont,xats){
    $.ajax({
        url: "/chats/missatges/content",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_contingut":idCont,
            "id_xat":xats,
            "missatge":null
        },
        success: function(data){
           $(".span-envia-cont").hide();
        },error: function(data){
        }
      });
  }
  // Rebre tipus de reports
  function getReports(){
    $.ajax({
        url: "/get/reports",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        success: function(data){
          $(".envia-report option").remove();
           $.each(data, function(index,element){
            let option=$("<option>");
            option.val(element.id);
            option.text(element.explicacio);
            $(".envia-report").append(option);
            $(".span-envia-report").hide();
           });
           $(".button-envRep").off("click");
           $(".button-envRep").on("click",function(){
            let idusr=$(this).val();
            let rep=$(this).parent().find(".envia-report").val();
            enviaReport(idusr,rep);
          });
        },error: function(data){
        }
      });
  }
// Enviar el Report
  function enviaReport(idusr,rep){
    $.ajax({
        url: "/back/admin/u/notify",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "user":idusr,
            "avis":rep
        },
        success: function(data){
           $(".span-envia-cont").hide();
           $(".span-envia-report").hide();
        },error: function(data){
        }
      });
  }
// Carregar els missatges anteriors
  function CarregaMissatgesAnteriors(idChat,index){
    $.ajax({
        url: "/chats/missatges/anterior",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "id_xat":idChat,
            "index":index
        },
        dataType: 'json',
        success: function(data){   
          if(data.length>0){
            data=data.sort(function (a, b) {
          return (b.id - a.id)
        });                
          //Mensages
          let uFecha="";
          let fechaHoy=new Date();
          $.each(data, function(index,element){
            let fecha=new Date(element.created_at);
            let li=$("<li>");
            if(element.id_usuari==AUTH.id){
              li.addClass("out");
            }else{
              li.addClass("in");
            }
            let chatImg=$("<div>");
            chatImg.addClass("chat-img");
            let imgPerf=$("<img>");
            imgPerf.attr("alt","Avtar");
            imgPerf.attr("src","{{asset('images/perfil/usuarios/')}}/"+element.foto);
            chatImg.append(imgPerf);
            let chatBody=$("<div>");
            chatBody.addClass("chat-body");
            let chatMessage=$("<div>");
            chatMessage.addClass("chat-message");
            let name=$("<h5>");
            name.text(element.name);
            let msg=$("<p>");
            msg.text(element.missatge);
            let hora=$("<p>");
            let minuto=fecha.getMinutes();
            if(minuto<10){
              minuto="0"+minuto;
            }
            hora.text(fecha.getHours()+":"+minuto);
            chatMessage.append(name);
            chatMessage.append(msg);
            if(element.id_contingut!=null){
              let aCont=$("<a>");
              aCont.attr("href","{{asset('contingut/')}}"+"/"+element.id_contingut);
              aCont.addClass("msgContingut");
              let imgCon=$("<img>");
              if(element.contingut.tipus_contingut==1){
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.url);
              }else{
                imgCon.attr("src","{{asset('contenido/1/')}}/"+element.contingut.portada);
              }
              if(element.contingut.majoria_edat==1){
                imgCon.css({
   'filter'         : 'blur(30px)',
   '-webkit-filter' : 'blur(30px)',
   '-moz-filter'    : 'blur(30px)',
   '-o-filter'      : 'blur(30px)',
   '-ms-filter'     : 'blur(30px)'
});
            } 
              aCont.append(imgCon);
              chatMessage.append(aCont);
            }
            chatMessage.append(hora);  
            chatBody.append(chatMessage); 
            li.append(chatImg);
            li.append(chatBody);            
            $(".chat-list").prepend(li);
            if(uFecha!=(fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())){
              let liFecha=$("<li>");
              if((fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())==(fechaHoy.getDate()+"/"+(fechaHoy.getMonth()+1)+"/"+fechaHoy.getFullYear())){
                liFecha.text("Hoy");
              }else {
                let fechaAyer="";
                if(fechaHoy.getDate()-1!=0){
                  fechaAyer=(fechaHoy.getDate()-1)+"/"+(fechaHoy.getMonth()+1)+"/"+fechaHoy.getFullYear();
                }else if(fechaHoy.getMonth()!=0){
                  fechaAyer=fechaHoy.getDate()+"/"+fechaHoy.getMonth()+"/"+fechaHoy.getFullYear();
                }else{
                  fechaAyer=fechaHoy.getDate()+"/"+fechaHoy.getMonth()+"/"+(fechaHoy.getFullYear()-1);
                }
                if((fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear())==fechaAyer){
                  liFecha.text("Ayer");
                }else{
                  liFecha.text(fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear());
                }
              }
              liFecha.css("color","black");
              liFecha.css("text-align","center");
              liFecha.addClass("fechaChat");
              uFecha=fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
              $(".chat-list").prepend(liFecha);
            }
          });
          }
        }
    });
  }
  
</script>
