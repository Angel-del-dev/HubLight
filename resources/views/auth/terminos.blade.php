@extends('front.layout.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teminos y Condiciones') }}</div>

                <div class="card-body" style="height: 70vh;">
                    <ol>
                        <li>Reglas</li>
                        <ul>
                            <li>No suplantes a otras personas ni nos proporciones información incorrecta.</li>
                            <li>No realices actividades ilegales, engañosas o fraudulentas, ni con fines ilegales o no autorizados</li>
                            <li>No puedes infringir estas Condiciones ni nuestras políticas (ni ayudar o animar a otras personas a hacerlo), especialmente las Normas comunitarias de Hub Light, las Políticas para desarrolladores y las Normas sobre música.</li>
                            <li>No puedes realizar ninguna acción que interfiera con el Servicio o impida que funcione como está previsto</li>
                            <li>No intentes recopilar información o acceder a ella, ni crear cuentas valiéndote de medios no autorizados</li>
                            <li>No puedes vender ni adquirir cuentas o datos que hayas obtenido a través de nosotros o nuestro Servicio, ni tampoco conceder licencias en relación con ellos.</li>
                            <li>No puedes publicar información privada o confidencial de otra persona sin su permiso ni realizar acciones que vulneren los derechos de terceros, incluidos los de propiedad intelectual e industrial (por ejemplo, infracciones relacionadas con los derechos de autor o marca, falsificaciones o artículos pirateados).</li>
                        </ul>
                        <li>Permisos que nos concedes</li>
                        <ul>
                            <li>No reclamamos la propiedad de tu contenido, pero nos concedes una licencia para usarlo.</li>
                        </ul>
                        <li>Eliminación de contenido, e inhabilitación o cancelación de la cuenta</li>
                        <ul>
                            <li>Si un SuperAdministrador encuentra inapropiado un contenido tiene el derecho de borrarlo</li>
                        </ul>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".isSelected").removeClass("isSelected");
    });
</script>
@endsection