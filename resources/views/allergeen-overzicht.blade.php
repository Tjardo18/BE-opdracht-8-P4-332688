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
        <th>Naam product</th>
        <th>Naam allergenen</th>
        <th>Omschrijving</th>
        <th>Aantal aanwezig</th>
        <th>Info</th>
        </thead>
        <tbody>
        @foreach ($result as $allergeen)
            <tr>
                <td>{{$allergeen->pNaam}}</td>
                <td>{{$allergeen->aNaam}}</td>
                <td>{{$allergeen->aOmschrijving}}</td>
                <td>{{$allergeen->mAantalAanwezig}}</td>
                <td>
                    <a href="/leverancier-details/{{$allergeen->lId}}">
                        <i class='fa-solid fa-question' style='color: #0000ff;'></i>
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
