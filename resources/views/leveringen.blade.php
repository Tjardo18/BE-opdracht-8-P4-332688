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
        Naam Leverancier: <span>{{ $leverancier[0]->Naam }}</span>
    </h3>
    <h3>
        Contactpersoon Leverancier: <span>{{ $leverancier[0]->ContactPersoon }}</span>
    </h3>
    <h3>
        Leveranciernummer: <span>{{ $leverancier[0]->leverancierNummer }}</span>
    </h3>
    <h3>
        Mobiel: <span>{{ $leverancier[0]->mobiel }}</span>
    </h3>
    <table>
        <thead>
        @if ($result == null)
        @else
            <th>Naam product</th>
            <th>Aantal in magazijn</th>
            <th>Verpakkingseenheid</th>
            <th>Laatste levering</th>
            <th>Nieuwe levering</th>
        @endif
        </thead>
        <tbody>
        @if ($result == null)
            <h1 style='text-align: center'>Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin</h1>
        @else
            @foreach ($result as $levering)
                <tr>
                    <td>{{$levering->PNaam}}</td>
                    <td>{{$levering->AantalAanwezig}}</td>
                    <td>{{$levering->VerpakkingsEenheid}} kg</td>
                    <td>{{$levering->DatumLevering}}</td>
                    <td>
                        <a href='/nieuwe-levering/{{$levering->Pid}}'>
                            <i class='bx bx-plus-circle' style='color: #ff2287'></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<script src="{{ asset('js/column.js') }}"></script>

</body>

</html>
