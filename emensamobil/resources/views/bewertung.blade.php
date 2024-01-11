@extends("layouts.layout_werbeseite")

@section('title')
    Bewertung abgeben
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
    <img src="img/mensabild.jpg" alt="Banner">

    <h1>Bewertung abgeben zu {{  $gerichtname[0]->name}}</h1>
    <img src="{{ asset('img/gerichte/' . ($bildname[0]->bildname ?: '00_image_missing.jpg')) }}" alt="{{ $bildname[0]->bildname }}">

    <form class="bewertungsformular" id="bewertung-form" action="/bewertung_verifizieren?id={{$id}}" method="post">
        @csrf
        <label for="sterne_bewertung">Ihre Sterne-Bewertung:</label>
        <select id="sterne_bewertung" name="sterne_bewertung" required>
            <option value="sehr schlecht">Sehr schlecht</option>
            <option value="schlecht">Schlecht</option>
            <option value="gut">Gut</option>
            <option value="sehr gut">Sehr gut</option>
        </select><br><br>

        <label for="bemerkung">Geben Sie nun eine kleine Bemerkung ab (Mindestens 5 Zeichen):</label>
        <textarea id="bemerkung" name="bemerkung" rows="7" cols="45" required></textarea><br><br>

        <button type="submit">Bewertung abschicken</button>
    </form>

    @if(isset($_SESSION['bewertung_fehler']))
        @if($_SESSION['bewertung_fehler'] == true)
            <p style="color: red; font-size: 18px; font-weight: bold">Bitte geben Sie 5 oder mehr Zeichen ein!</p>
        @endif
    @endif
@endsection

@section('footer')
    <li><p> &copy; E-Mensa GmbH</p></li>
    <li><p> Haider Abbas und Yannik Sinthern</p></li>
    <li><a href="#impressum">Impressum</a></li>
@endsection
