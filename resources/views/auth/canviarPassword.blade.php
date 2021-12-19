@extends('front.layout.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Restablecer Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="user" type="text" class="form-control " name="password" required autocomplete="current-password">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mt-3">
                            <button type="button" class="btn btn-primary resetPassword">
                                {{ __('Recordar mi contraseña') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".resetPassword").on("click",function(){
            verifica($("#email").val(),$("#user").val());
        });
    });

    function verifica(email,name){
    
    $.ajax({
        url: "/generepassword",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            "email":email,
            "name":name
        },
        success: function(data){
           if(data){
               alert("La contraseña se ha canviado correctamente, revisa el correo electronico");
               window.location="/login";
           }else{
                alert("El email o el usuario no coinciden");
           }
        },error: function(data){
           console.log(data);
        }
      });
  }
</script>
@endsection
