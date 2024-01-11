@extends("layouts.layout_werbeseite")

@section('title')
    Ihr Profil
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
    <h1>Ihr Profil</h1><br><br>
    <p>Ihr Name: {{ $_SESSION['user_name'] }}</p>
    <p>Ihre Email : {{ $email }}</p>
    <p>So oft haben Sie sich angemeldet: {{ $anzahlanmeldungen }}</p>
    <p>Admin-Account?:
        @if($admin)
            Ja
        @else
            Nein
        @endif </p>

@endsection

@section('footer')
    <li><p> &copy; E-Mensa GmbH</p></li>
    <li><p> Haider Abbas und Yannik Sinthern</p></li>
    <li><a href="#impressum">Impressum</a></li>
@endsection
