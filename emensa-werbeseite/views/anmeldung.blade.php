@extends("layouts.layout_werbeseite")

@section('title')
    Anmeldung
@endsection

@push('css')
    <?php include('css/werbeseite.css') ?>
@endpush

@section('header')
    <img src="img/georghoever.jpeg" alt="E-Mensa Logo">
@endsection

@section('nav')
@endsection

@section('main')
    <img src="img/mensabild.jpg" alt="Banner">

    <h1>Bitte anmelden</h1>

    <form id="anmeldung-form" action="/anmeldung_verifizieren" method="post">
        <label for="anmeldung_email">Ihre Email:</label><br>
        <input type="email" id="anmeldung_email" name="anmeldung_email" required><br><br>

        <label for="anmeldung_passwort">Ihr Passwort:</label><br>
        <input type="password" id="anmeldung_passwort" name="anmeldung_passwort" required><br><br>

        <button type="submit">Anmelden</button><br><br>
    </form>

    @if(isset($_SESSION['login_fehler']))
        @if($_SESSION['login_fehler'] == true)
            <p style="color: red; font-size: 18px; font-weight: bold">Bitte überprüfen Sie ihr Email oder Passwort!</p>
        @endif
    @endif
@endsection

@section('footer')
    <li><p> &copy; E-Mensa GmbH</p></li>
    <li><p> Haider Abbas und Yannik Sinthern</p></li>
    <li><a href="#impressum">Impressum</a></li>
@endsection
