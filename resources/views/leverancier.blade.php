<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/store-avatar.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $title }}</title>
</head>

<body>

<div class="logo">
    <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo-wit.png') }}">
    </a>
</div>

<div class="card">
    <div class="title">
        <h1>
            {{ $title }}
        </h1>
    </div>
    <h3>
        Naam Leverancier: <span>{{ $result[0]->LNaam }}</span>
    </h3>
    <h3>
        Contactpersoon Leverancier: <span>{{ $result[0]->contactPersoon }}</span>
    </h3>
    <h3>
        Leveranciernummer: <span>{{ $result[0]->leverancierNummer }}</span>
    </h3>
    <h3>
        Mobiel: <span>{{ $result[0]->mobiel }}</span>
    </h3>
    <table>
        <thead>
        @if ($result[0]->AantalAanwezig == 0)
        @else
            <th>Naam Product</th>
            <th>Datum Laatste Levering</th>
            <th>Aantal</th>
            <th>Eerstvolgende Levering</th>
        @endif
        </thead>
        <tbody>
        @if ($result[0]->AantalAanwezig == 0)
            <h1 style='text-align: center'>Er is van dit product op dit moment geen voorraad aanwezig,<br> de verwachte
                eerstvolgende levering is: <span>" . {{$result[0]->DatumEVL}} . "</span></h1>
        @else
            @foreach ($result as $leverancier)
                <tr>
                    <td>{{$leverancier->PNaam}}</td>
                    <td>{{$leverancier->datumLevering}}</td>
                    <td>{{$leverancier->aantal}}</td>
                    <td>{{$leverancier->DatumEVL}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<script src="{{ asset('js/column.js') }}"></script>

</body>

</html>
