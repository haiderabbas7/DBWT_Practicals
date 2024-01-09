@extends("layouts.layout_werbeseite")

@section('title')
    Anmeldung
@endsection

@push('css')
    <?php include('C:\Users\Haider\PhpstormProjects\E-Mensa-Werbeseite\emensamobil\resources\css\werbeseite.css') ?>
@endpush

@section('header')
    <img src="img/georghoever.jpeg" alt="E-Mensa Logo">

@endsection

@section('nav')
    <a href="/" style="margin-left: 50px">Zurück zur Hauptseite</a>
@endsection



@section('main')
    <img src="img/mensabild.jpg" alt="Banner"><br><br>
    <h1>Die letzten 30 Bewertungen:</h1><br>
    <table>
    @for($i = 0; $i < count($bewertungen); $i++)
        <tr>
            <td>
                <p>Gericht: <b>{{$gerichtnamen[$i][0]->name}}</b></p><br>
                <p><b>{{$benutzernamen[$i][0]->name}}</b> schrieb am <b>{{$bewertungen[$i]->bewertungszeitpunkt}}</b>:</p>
                <p>"{{$bewertungen[$i]->bemerkung}}"</p><br>
                <p>Sterne-Bewertung: {{$bewertungen[$i]->sterne_bewertung}}</p>
            </td>
            <td>
                <img src="{{ asset('img/gerichte/' . ($bildernamen[$i][0]->bildname ?: '00_image_missing.jpg')) }}" alt="{{ $bildernamen[$i][0]->bildname }}" width="200" height="200">
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
