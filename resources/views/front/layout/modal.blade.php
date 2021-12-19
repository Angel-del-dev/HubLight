{{-- Css --}}
<link rel="stylesheet" href={{asset("/css/front/modal.css")}}>
{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- Header --}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Contenido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- Body --}}
      <div class="modal-body">
        {{-- Formulari --}}
        <form id="formModal" action="/contingut" method="POST" enctype="multipart/form-data">
          @method('POST')
          @csrf
          <div class="row">
            {{-- Tipo contingut i +18 --}}
            <div>
              <label for="tipoC">Tipo de contenido</label>
                <select class="form-select" id="tipoC" name="tipoC" aria-label="Default select example">
                </select>
              <label for="ageRestrict">+18</label>
              <input type="checkbox" name="ageRestrict"/>
            </div>
            {{-- Portada --}}
            <div>
              <label for="portada" class="form-portada">
                <div class="upload-icon">
                  <img style="cursor: pointer;" src={{asset('images/No-Image.png')}} alt="Portada" data-toggle="tooltip" data-placement="right" title="Haz clic para insertar una portada" class="img-portada">
                </div>
              </label>
              <input id="portada" name="portada" hidden type="file" form="formModal"/>
            </div>
            {{-- Arxiu --}}
            <div>
              {{-- Imatge --}}
              <label for="arxiu-i" id="arxiu-img">
                <div class="upload-icon">
                  <img style="cursor: pointer;" src={{asset('images/No-Image.png')}} alt="Arxiu" data-toggle="tooltip" data-placement="right" title="Haz clic para insertar un archivo" class="img-arxiu image-thumbnail">
                </div>
              </label>
              {{-- Musica --}}
              <label for="arxiu" id="arxiu-musica">
                <div class="upload-icon">
                  <audio controls="controls" style="cursor: pointer;" src={{asset('images/No-Image.png')}} alt="Arxiu" data-toggle="tooltip" data-placement="right" class="music-arxiu"></audio>
                </div>
              </label>
              {{-- Video --}}
              <label for="arxiu" id="video-musica">
                <div class="upload-icon">
                  <video controls="controls" style="cursor: pointer;" src={{asset('images/No-Image.png')}} alt="Arxiu" data-toggle="tooltip" data-placement="right" class="video-arxiu embed-responsive"></video>
                </div>
              </label>
              {{-- Inputs Arxiu --}}
              <div>
                <label for="arxiu" id="arxiu-otros">Archivo</label>
                <input id="arxiu" name="arxiu" type="file" form="formModal"/>
                <input id="arxiu-i" name="arxiu" hidden type="file" form="formModal"/>
                <input id="arxiu-m" name="arxiu" type="file" form="formModal"/>
                <input id="arxiu-v" name="arxiu" type="file" form="formModal"/>
              </div>
            </div>
            {{-- Titol --}}
            <div class="modal-row">
              <label for="titol">Titulo</label>
              <input id="titol" name="titol" type="text" form="formModal"/>
            </div>
            {{-- Descripcio --}}
            <div class="modal-row">
              <label for="desc">Descripción</label>
              <textarea id="desc" name="desc"></textarea>
            </div>
            {{-- Etiquetes --}}
            <div title="Selecciona las etiquetas que quiera, si no existen puede escribiras manualmente y se crearan" class="modal-row">
              <label>Selecciona las etiquetas (Separalas por comas):</label>
              <input type="text" list="Suggestions" multiple="multiple" name="tags" form="formModal"/>
              <datalist id="Suggestions"> </datalist>
            </div>
            {{-- Drets autor --}}
            <div class="modal-row">
              {{-- Tipo Dret --}}
              <div>
                <label for="derechoA">Derechos de autor</label>
                <select class="form-select" id="derechoA" name="derechoA" aria-label="Default select example"> </select>
              </div>
              {{-- Llicencia --}}
              <div id="licencias">
                <label for="linkCopy">Licencia</label>
                <input id="linkCopy" name="linkCopy" type="text" placeholder="url para demostrar que la licencia exista"/>
              </div>
          </div>
        </div>
      </div>
    </form>
    {{-- Footer --}}
      <div class="modal-footer">
        {{-- Botons Submit --}}
        <button type="button" class="btn btn-secondary" data-dismiss="modal" form="formModal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="submitForm" form="formModal">Subir</button>
      </div>
    </div>
  </div>
</div>
{{-- Scripts --}}
<script>
  // Variable tipo Contingut
  let tipoC;
  // Document Ready
  $(document).ready(function(){
    // Label Portada
    $("#portada").on("change",function() {
      let inpFile = $("#portada");
      let previewImage = document.querySelector(".img-portada");

      let file = this.files[0];

      // Si hay un archivo seleccionado, crea un FileReader para poder leerlo, y lo enseña
      if(file) {
        const reader = new FileReader();
        reader.addEventListener("load",function() {
          previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
      }
    });
    // Label Imatge
    $("#arxiu-i").on("change",function() {
      let inpFile = $("#arxiu-i");
      let previewImage = document.querySelector(".img-arxiu");

      let file = this.files[0];

      // Si hay un archivo seleccionado, crea un FileReader para poder leerlo, y lo enseña
      if(file) {
        const reader = new FileReader();
        reader.addEventListener("load",function() {
          previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
      }
    });
    // Label Musica
    $("#arxiu-m").on("change",function() {
      let inpFile = $("#arxiu-m");
      let previewImage = document.querySelector(".music-arxiu");

      let file = this.files[0];

      // Si hay un archivo seleccionado, crea un FileReader para poder leerlo, y lo enseña
      if(file) {
        const reader = new FileReader();
        reader.addEventListener("load",function() {
          previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
      }
    });
    // label Video
    $("#arxiu-v").on("change",function() {
      let inpFile = $("#arxiu-v");
      let previewImage = document.querySelector(".video-arxiu");

      let file = this.files[0];

      // Si hay un archivo seleccionado, crea un FileReader para poder leerlo, y lo enseña
      if(file) {
        const reader = new FileReader();
        reader.addEventListener("load",function() {
          previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
      }
    });
    // Funcions Rebre Dades
    getDerechos();
    getTipo();
    getTags();
    // Funcio SelectTipo
    $("#tipoC").change(function(){
      selectTipo();
    });
    // Funcio SelectLicencia
    $("#derechoA").change(function(){
      selectLicencia();
    })
    // Funcio Envia Dades
    $("#submitForm").click(function(event){
      $("#submitForm").hide();
      // Funcio Valida return bool
      if(!valida()){
        $("#submitForm").show();
        event.preventDefault();
      }
    });

    $("#arxiu").on("change",function(){
    });
  });
  // Dades Drets Autor
  function getDerechos() {
    // Ajax
    $.ajax({
      url: "/derechosautor",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      dataType: 'json',
      success: function(data){
        // Success
        // Start Foreach
        $.each(data, function(index,element){
          // Opcions Select
          var option=$("<option>");
          if(element.id_dret==2){
            option.text(element.tipus+" (No tengo Derechos de autor)");
          }else{
            option.text(element.tipus);
          }
          
          option.val(element.id_dret);
          $("#derechoA").append(option);
        });
        // End Foreach
        $('#derechoA option[value="2"]').attr("selected",true);
        selectLicencia();
      }
    });
  }
  // Dades Tipo Contingut
  function getTipo() {
    // Ajax
    $.ajax({
      url: "/tipocontenido",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      dataType: 'json',
      success: function(data){
        // Success
        // Start Foreach
        $.each(data, function(index,element){
          // Opcions Select
          var option=$("<option>");
          option.text(element.tipus);
          option.attr("title",element.Descripcio);
          option.val(element.id);
          $("#tipoC").append(option);
        });
        // End Foreach
        tipoC=data;
        selectTipo();
      }
    });
  }
  // Dades Etiquetes
  function getTags() {
    // Ajax
    $.ajax({
        url: "/tags",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        dataType: 'json',
        success: function(data){
          // Success
          // Start Foreach
          $.each(data, function(index,element){
            // Opcions Select
            var option=$("<option>");
            option.text(element.nombre);
            $("#Suggestions").append(option);
          });
          // End Foreach
          multipleData();
        }
    });
  }
  // Configura Inputs del Modal
  function selectTipo(){
    // Oculta Inputs Importants
    var tipo=$("#tipoC").val();
    $(".form-portada").hide();
    $("#arxiu-otros").hide();
    $("#arxiu-img").hide();
    $("#arxiu").hide();
    $("#arxiu-m").hide();
    $("#arxiu-v").hide();
    $("#arxiu").prop( "disabled", true);
    $("#arxiu-i").prop( "disabled", true);
    $("#arxiu-m").prop( "disabled", true);
    $("#arxiu-v").prop( "disabled", true);
    $("#arxiu-musica").hide();
    $("#video-musica").hide();
    $("#portada").prop( "disabled", true);
    // Selecciona el tipus i ensenya els inputs que li toquen
    switch(tipo){
      // Imatge
      case  "1":
        $("#arxiu-img").show();
        $("#arxiu-i").prop( "disabled", false);
        $(".img-arxiu").attr("title","Haz click para añadir un archivo: "+tipoC[0].Descripcio);
        break;
      // Texte
      case "2":
        $(".form-portada").show();
        $("#portada").prop( "disabled", false);
        $("#arxiu").show();
        $("#arxiu").prop( "disabled", false);
        $("#arxiu-otros").show();
        $("#arxiu").attr("title","Haz click para añadir un archivo: "+tipoC[1].Descripcio);
          break;
        // Musica
      case "3":
        $(".form-portada").show();
        $("#portada").prop( "disabled", false);
        $("#arxiu-musica").show();
        $("#arxiu-m").show();
        $("#arxiu-m").prop( "disabled", false);
        $("#arxiu-otros").show();
        $("#arxiu-m").attr("title","Haz click para añadir un archivo: "+tipoC[2].Descripcio);
          break;
        // Video
      case "4":
        $(".form-portada").show();
        $("#portada").prop( "disabled", false);
        $("#video-musica").show();
        $("#arxiu-v").show();
        $("#arxiu-v").prop( "disabled", false);
        $("#arxiu-otros").show();
        $("#arxiu-v").attr("title","Haz click para añadir un archivo: "+tipoC[3].Descripcio);
          break;
        // Altres
      case "5":
        $(".form-portada").show();
        $("#portada").prop( "disabled", false);
        $("#arxiu").show();
        $("#arxiu").prop( "disabled", false);
        $("#arxiu-otros").show();
        $("#arxiu").attr("title","Haz click para añadir un archivo: "+tipoC[4].Descripcio);
          break;
    }
  }
  // Configura Drets Autor del modal
  function selectLicencia(){
    var tipo=$("#derechoA").val();
    // Oculta Llicencia si usuari no te drets
    if(tipo=="2"){
      $("#licencias").hide();
      $("#linkCopy").prop( "disabled", true);
    }else{
      $("#licencias").show();
      $("#linkCopy").prop( "disabled", false);
    }
  }
  // Validacio del formulari
  function valida(){
    let validacion=true;
    let error="";
    var tipo=$("#tipoC").val();
    // Troba el tipus per millorar la validacio
    switch(tipo){
      // Imatge
      case "1":
        // Arxiu buit
        if($("#arxiu-i").val()==null||$("#arxiu-i").val()==""||$("#arxiu-i").val()==undefined){
          error=error+"¡No se encuentra el archivo!";
          validacion=false;
        }else{
          // Extensio Arxiu
          filename= $("#arxiu-i").val().split('.').pop();
          if(!validaExt(filename,tipoC[0].Descripcio)){
            error=error+"¡Extension incorrecta!";
            validacion=false;
          }
          let espai=parseInt(tipoC[0].espai,10)*1000;
          if($("#arxiu-i")[0].files[0].size>espai){
            error=error+"¡Archivo muy pesado!";
            validacion=false;
          }
        }
        break;
      // Texte
      case "2":
        // Arxiu buit
        if($("#arxiu").val()==null||$("#arxiu").val()==""||$("#arxiu").val()==undefined){
          error=error+"¡No se encuentra el archivo!";
          validacion=false;
        }else{
          // Extensio Incorrecte
          filename= $("#arxiu").val().split('.').pop();
          if(!validaExt(filename,tipoC[1].Descripcio)){
            error=error+"¡Extension incorrecta!";
            validacion=false;
          }
        }
        // Titol Requerit
        if($("#titol").val()==null||$("#titol").val()==""||$("#titol").val()==undefined){
          error=error+"¡No se encuentra el titulo!";
          validacion=false;
        }
        let espai=parseInt(tipoC[1].espai,10)*1000;
        if($("#arxiu")[0].files[0].size>espai){
            error=error+"¡Archivo muy pesado!";
            validacion=false;
          }
        break;
      // Musica
      case "3":
        // Arxiu buit
        if($("#arxiu-m").val()==null||$("#arxiu-m").val()==""||$("#arxiu-m").val()==undefined){
          error=error+"¡No se encuentra el archivo!";
          validacion=false;
        }else{
          // Extensio correcte
          filename= $("#arxiu-m").val().split('.').pop();
          if(!validaExt(filename,tipoC[2].Descripcio)){
            error=error+"¡Extension incorrecta!";
            validacion=false;
          }
          let espai=parseInt(tipoC[2].espai,10)*1000;
          if($("#arxiu-m")[0].files[0].size>espai){
            error=error+"¡Archivo muy pesado!";
            validacion=false;
          }
        }
        break;
      // Video
      case "4":
        // Arxiu buit
        if($("#arxiu-v").val()==null||$("#arxiu-v").val()==""||$("#arxiu-v").val()==undefined){
          error=error+"¡No se encuentra el archivo!";
          validacion=false;
        }else{
          // Extensio incorrecte
          filename= $("#arxiu-v").val().split('.').pop();
          if(!validaExt(filename,tipoC[3].Descripcio)){
            error=error+"¡Extension incorrecta!";
            validacion=false;
          }
          let espai=parseInt(tipoC[3].espai,10)*1000;
          if($("#arxiu-v")[0].files[0].size>espai){
            error=error+"¡Archivo muy pesado!";
            validacion=false;
          }
        }
        break;
      // Altres
      case "5":
      // Arxiu buit
        if($("#arxiu").val()==null||$("#arxiu").val()==""||$("#arxiu").val()==undefined){
          error=error+"¡No se encuentra el archivo!";
          validacion=false;
        }else{
          // Extensio incorrecte
          filename= $("#arxiu").val().split('.').pop();
          if(!validaExt(filename,tipoC[4].Descripcio)){
            error=error+"¡Extension incorrecta!";
            validacion=false;
          }
          let espai=parseInt(tipoC[4].espai,10)*1000;
          if($("#arxiu")[0].files[0].size>espai){
            error=error+"¡Archivo muy pesado!";
            validacion=false;
          }
        }
      break;
    }
    // Validacio Drets Autor 
    var tipo=$("#derechoA").val();
    if(tipo!="2"){
      if($("#linkCopy").val()==null||$("#linkCopy").val()==""||$("#linkCopy").val()==undefined){
        error=error+"¡Porfavor inserte su licencia!";
        validacion=false;
      }
    }
    // Ensenya els errors si ni ha
    if(!validacion){
      alert(error);
    }else{
      $("#loadScreen").show();
    }
    // Torna bool
    return validacion;
  }
  // Valida si les extensions del arxiu, coincideix amb les extensions disponibles
  function validaExt(arxiu,disp){
    var ext=disp.split(" ");
    let correctExt=false;
    $.each(ext, function(index,element){
      if(element==arxiu){
        correctExt=true;
        return true;
      }
    });
    return correctExt;
  }
  // Metode per fer MultiDatalist
  function multipleData(){
    const separator = ',';
    for (const input of document.getElementsByTagName("input")) {
      if (!input.multiple) {
        continue;
      }
      if (input.list instanceof HTMLDataListElement) {
        const optionsValues = Array.from(input.list.options).map(opt => opt.value);
        let valueCount = input.value.split(separator).length;
        input.addEventListener("input", () => {
          const currentValueCount = input.value.split(separator).length;
          // Do not update list if the user doesn't add/remove a separator
          // Current value: "a, b, c"; New value: "a, b, cd" => Do not change the list
          // Current value: "a, b, c"; New value: "a, b, c," => Update the list
          // Current value: "a, b, c"; New value: "a, b" => Update the list
          if (valueCount !== currentValueCount) {
            const lsIndex = input.value.lastIndexOf(separator);
            const str = lsIndex !== -1 ? input.value.substr(0, lsIndex) + separator : "";
            filldatalist(input, optionsValues, str);
            valueCount = currentValueCount;
          }
        });
      }
    }
    function filldatalist(input, optionValues, optionPrefix) {
      const list = input.list;
      if (list && optionValues.length > 0) {
        list.innerHTML = "";
        const usedOptions = optionPrefix.split(separator).map(value => value.trim());
        for (const optionsValue of optionValues) {
          if (usedOptions.indexOf(optionsValue) < 0) {
            const option = document.createElement("option");
            option.value = optionPrefix + optionsValue;
            list.append(option);
          }
        }
      }
    }
  }
</script>
