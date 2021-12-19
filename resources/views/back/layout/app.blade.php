<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel-administrador</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href={{asset('css/back/app.css')}}>
    <link rel="stylesheet" href={{asset('css/back/extra.css')}}>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script src={{asset('js/back/sidebar.js')}}></script>
        <script src={{asset('js/back/admin_info.js')}}></script>
        <script src={{asset('js/back/functions.js')}}></script>
        {{-- Activa tooltip global --}}
        <script>
            $(document).ready(function() {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
                // Genera el DataTable(paginación[libreria])
                $("#tableContent").DataTable([
                    page:false
                ]);
            });
        </script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @if (Auth::user()->es_admin!=1)
        <script>window.location= "/"</script>
    @endif
    @if (Auth::user()->deshabilitat===1)
        <script>window.location= "/"</script>
    @endif
    <div class="page-wrapper chiller-theme toggled">

        <main class="page-content" id="users">
            <div class="container-fluid">
                @include("back.layout.nav")
                @yield("content")
            </div>
        </main>
    </div>
</body>
</html>
