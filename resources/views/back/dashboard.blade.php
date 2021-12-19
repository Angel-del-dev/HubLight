@extends('back.layout.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<input type="hidden" id="page" value="dashboard" />
<input type="hidden" id="sub" value="dash" />
<input type="hidden" id="content" value="{{$content}}">
<input type="hidden" id="connected" value="{{$connected}}">
<input type="hidden" id="disconnected" value="{{$disconnected}}">
<div class="row">
    <div class="col-sm-6 col-lg-8 border rounded">
        <canvas id="cont"></canvas>
    </div>
    <div class="col-sm-6 col-lg-4 border rounded">
        <canvas id="user"></canvas>
    </div>
    <div class="col-sm-6 col-lg-6 border rounded">
        <canvas id="active"></canvas>
    </div>
    <div class="col-sm-6 col-lg-6 border rounded">
        <canvas id="msg"></canvas>
    </div>
</div>

<script>
    let datos=JSON.parse(document.getElementById("content").value);
    let data_raw=datos;

    // Creamos valores y labels para primer chart
    let data_content=[];
    let labels_content=[];
    for(let d of data_raw) {
        data_content.push(d.contenido_total);
        let aux = d.created_at.split("T")
        labels_content.push(aux[0]);
    }
    const line = {
        labels: labels_content,
        datasets: [{
            label: 'Publicaciones',
            data: data_content,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.4
        }]
    };
    // Final primer chart
    // Creamos valores y labels para segundo chart

    let ctx = document.getElementById("cont").getContext("2d");
    let cont= new Chart(ctx,{
        // bar, line, radar, pie
        type:"line",
        data:line,
    });
    // Principio segundo chart
    let data_users=[{{$sanos}},{{$suspes}},{{$enperill}}];
    let labels_users=["Usuarios sanos","Usuaros bloqueados","Usuarios en peligro"];

    const pie = {
        labels: labels_users,
        datasets: [{
            label: 'Usuarios',
            data: data_users,
            fill: true,
            backgroundColor: [
                '#33FF74',
                '#FF3333',
                '#FFA200'
            ],
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.4
        }]
    };

    let ctx2 = document.getElementById("user").getContext("2d");
    let users= new Chart(ctx2,{
        // bar, line, radar, pie
        type:"pie",
        data:pie,
    });

    // Fin segundo chart

    // Principio tercer chart
    let data_active=[$('#connected').val(),$('#disconnected').val()]
    let labels_active=["Usuarios conectados","Usuarios desconectados"];

    const bar = {
        labels: labels_active,
        datasets: [{
            data: data_active,
            label: "Usuarios Conectados",
            fill: true,
            backgroundColor: [
                '#33FF74',
                '#C00'
            ],
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.4
        }]
    };

    let ctx3 = document.getElementById("active").getContext("2d");
    let active= new Chart(ctx3,{
        // bar, line, radar, pie
        type:"bar",
        data: bar,
    });

    // Fin tercer chart

    // Cuarto chart
    data_content=[];
    labels_content=[];
    for(let d of data_raw) {
        // console.log(d);
        data_content.push(d.missatges_totals);
        let aux = d.created_at.split("T")
        labels_content.push(aux[0]);
    }
    const line2 = {
        labels: labels_content,
        datasets: [{
            label: 'Mensajes totales',
            data: data_content,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.4
        }]
    };

    let ctx4 = document.getElementById("msg").getContext("2d");
    let msg= new Chart(ctx4,{
        // bar, line, radar, pie
        type:"line",
        data:line2,
    });
    // Fin cuarto chart
</script>
@endsection
