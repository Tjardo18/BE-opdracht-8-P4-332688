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
    <table>
        <thead>
        <th>Naam</th>
        <th>Contactpersoon</th>
        <th>Leveranciernummer</th>
        <th>Mobiel</th>
        <th>Aantal verschillende producten</th>
        <th>Toon producten</th>
        <th>Details</th>
        </thead>
        <tbody>
        @foreach ($result as $leverancier)
            <tr>
                <td>{{$leverancier->Naam}}</td>
                <td>{{$leverancier->ContactPersoon}}</td>
                <td>{{$leverancier->LeverancierNummer}}</td>
                <td>{{$leverancier->Mobiel}}</td>
                <td>{{$leverancier->ProductCount}}</td>
                <td>
                    <a href='/leveringen/{{$leverancier->id}}'>
                        <i class='bx bxs-package' style='color: #ff2287;'></i>
                    </a>
                </td>
                <td>
                    <a href='/leverancier-details/{{$leverancier->id}}'>
                        <i class='bx bxs-edit' style='color: #ff2287;'></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="{{ asset('js/column.js') }}"></script>

</body>

</html>
