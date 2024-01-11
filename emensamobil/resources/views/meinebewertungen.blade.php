@extends("layouts.layout_werbeseite")

@section('title')
    Ihre Bewertungen
@endsection

@push('css')
    <?php include($_SERVER['DOCUMENT_ROOT'] . '\..\resources\css\werbeseite.css') ?>
@endpush

@section('header')
    <img src="img/georghoever.jpeg" alt="E-Mensa Logo">

@endsection

@section('nav')
    <a href="/" style="margin-left: 50px">Zurück zur Hauptseite</a>
@endsection

@section('anmeldung')
    <div id="anmeldung-box">
        @if (!isset($_SESSION['login_ok']) || $_SESSION['login_ok'] == false)
            <a href="/anmeldung">Anmelden</a>
        @elseif (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == true)
            <p>Angemeldet als:  <span style="margin-right: 15px"><a href="/profil">{{ $_SESSION['user_name'] }}</a></span></p>
            <a href="/abmeldung">Abmelden</a>
        @endif
    </div>
@endsection

@section('main')
    <img src="img/mensabild.jpg" alt="Banner"><br><br>
    <h1>Ihre Bewertungen:</h1><br>
    <table>
        @for($i = 0; $i < count($bewertungen); $i++)
            <tr>
                <td>
                    <p>Gericht: <b>{{$gerichtnamen[$i][0]->name}}</b></p><br>
                    <p>Sie schrieben am <b>{{$bewertungen[$i]->bewertungszeitpunkt}}</b>:</p>
                    <p style="max-width: 650px; word-wrap: break-word;">"{{$bewertungen[$i]->bemerkung}}"</p><br>
                    <p>Sterne-Bewertung: <b>{{$bewertungen[$i]->sterne_bewertung}}</b></p>
                </td>
                <td>
                    <img src="{{ asset('img/gerichte/' . ($bildernamen[$i][0]->bildname ?: '00_image_missing.jpg')) }}" alt="{{ $bildernamen[$i][0]->bildname }}" width="200" height="200">
                </td>
                <td>
                    <a href="/bewertung_loeschen?id={{$bewertungen[$i]->id}}">Diese Bewertung loeschen</a>
                </td>
            </tr>
        @endfor
    </table>
@endsection

@section('footer')
    <li><p> &copy; E-Mensa GmbH</p></li>
    <li><p> Haider Abbas und Yannik Sinthern</p></li>
    <li><a href="#impressum">Impressum</a></li>
@endsection
