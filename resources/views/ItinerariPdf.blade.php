<html>
<head>
    <title>Itinerari</title>
    <style>
        @font-face {
            font-family: 'Jakarta';
            src: url("{{ storage_path('fonts/PlusJakartaSans-VariableFont_wght.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Jakarta', sans-serif;
            
        }



        .titol_gradient{
            width: 100%;
            padding: 30px;
            background-color: #FD68C4;
            /* background: linear-gradient(270deg, #FDDA5A 0%, #FD68C4 100%); */
        }
        .red{
            background-color: #FD68C4;
            padding: 30px;
        }
    </style> 
    <div class="titol_gradient">   
        <p>Itinerario</p>
    </div>
    <div>
        Itinerar:<br>
        Ciutat : {{ $itinerari->relCiutat->nom }}

        @foreach($itinerari->passos as $pas)
        <div class="pas">
            
            <p>{{ $pas->relPregunta->text }}</p>
            <h3>{{ $pas->relPregunta->titol }}</h3>
            <p><strong>Resposta:</strong> {{ $pas->relResposta->text }}</p>
        </div>
        @endforeach

    </div>

</html>