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
            width: 80%;
            padding: 20px;
            background-color: #FD68C4;
            font-size: 20px;
            font-weight: 900;
            /* background: linear-gradient(270deg, #FDDA5A 0%, #FD68C4 100%); */
        }
        .red{
            background-color: #FD68C4;
            padding: 30px;
        }

    .o-badge{
        color: #9F9F9F;
        padding: 0px 8px 2px 8px;
        text-align: center;
        border-radius: 16px;
        background: #FFE1F3;
        width: 90px;
        
    }

    td{
        width: 100%;
    }

    .minim-td {
        width: 100px;
    }

    .expand-td {
        width: auto;
    }

    </style> 
    <div class="titol_gradient">   
        <p>Tus preguntas y respuestas</p>
    </div>
    <div>
        Itinerar:<br>
        Ciudad : {{ $itinerari->relCiutat->nom }}

        @foreach($itinerari->passos as $pas)
        <div class="pas">
            <table>
                <tr>
                    <td colspan=2><p>
                        {!! \Illuminate\Support\Str::markdown($pas->relPregunta->text) !!}</p></td>
                </tr>
                <tr>
                    <td class="minim-td" rowspan=2><div class="o-badge">Pregunta {{ $loop->iteration }}<div></td>
                    <td class="expand-td"><h3>{{ $pas->relPregunta->titol }}</h3></td>
                </tr>
                <tr>
                    <td class="expand-td">    <p>{{ $pas->relResposta->text ?? '' }} </p></td>
                </tr>
        </div>
        @endforeach

    </div>

</html>