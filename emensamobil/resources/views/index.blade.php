@extends("layouts.layout_werbeseite")

@section('title')
    Ihre E-Mensa
@endsection


@push('css')
    <?php include('C:\Users\Haider\PhpstormProjects\E-Mensa-Werbeseite\emensamobil\resources\css\werbeseite.css') ?>
@endpush


@section('header')
    <img src="img/georghoever.jpeg" alt="E-Mensa Logo">
@endsection


@section('nav')
    <li><a href="#ankündigung">Ankündigung</a></li>
    <li><a href="#speisen">Speisen</a></li>
    <li><a href="#zahlen">Zahlen</a></li>
    <li><a href="#kontakt">Kontakt</a></li>
    <li><a href="#wichtigFürUns">Wichtig für uns</a></li>
    <li><a href="#wunschgericht">Ihr Wunschgericht</a></li>
    <li><a href="/bewertungen">Bewertungen</a></li>
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
    <section id="ankündigung">
        <h1>Bald gibt es Essen auch online ;)</h1>
        <p id="boxaroundp">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores veritatis fugit ab magnam nesciunt autem necessitatibus, quia quo cupiditate, ad vel minus nam odit ex! Eum quidem commodi id autem!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sed. Cupiditate blanditiis minus aperiam corrupti, veniam cumque adipisci quo esse exercitationem aspernatur praesentium fugiat commodi iste, aut nemo voluptas ullam.
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum quam distinctio pariatur soluta fugiat quae, nobis nesciunt, modi labore asperiores maiores minus iusto totam, cumque enim quibusdam accusantium eaque ducimus?
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam aperiam vel debitis ad expedita aliquam sit vero soluta in obcaecati quidem suscipit, quod doloribus eligendi! Dolores assumenda reprehenderit unde incidunt.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis tempora eligendi aliquam architecto sunt sed, ratione quos doloremque deserunt omnis accusamus quisquam, corrupti ex dicta? Neque nam maiores esse explicabo!
        </p>
    </section>
    <section id="speisen">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table>
            <tr>
                <td></td>
                <td>Preis intern</td>
                <td>Preis extern</td>
                <td>Bild</td>
            </tr>
            @for($i = 0; $i < count($gerichte_sql); $i++)
                <tr>
                    <td>
                        {{ $gerichte_sql[$i]->name }}<br>
                        @if(isset($used_allergens[$i]) && !empty($used_allergens[$i]))
                            @foreach($used_allergens[$i] as $used_allergen)
                                <sub><b>({{ $used_allergen->code }})</b></sub>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $gerichte_sql[$i]->preisintern }}€</td>
                    <td>{{ $gerichte_sql[$i]->preisextern }}€</td>
                    <td>
                        <img src="{{ asset('img/gerichte/' . ($bildernamen[$i][0]->bildname ?: '00_image_missing.jpg')) }}" alt="{{ $bildernamen[$i][0]->bildname }}" width="200" height="200">
                    </td>
                    @if(isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == true)
                        <td>
                            <a href="/bewertung?id={{$gerichte_sql[$i]->id}}">Bewerten Sie dieses Gericht</a>
                        </td>
                    @endif
                </tr>
            @endfor


            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </table>
    </section>

    <section id="wichtigFürUns">
        <h1>Das ist uns wichtig</h1><br>
        <ul>
            <li class="wichtig">Beste frische saisonale Zutaten</li>
            <li class="wichtig">Ausgewogene abwechslungsreiche Gerichte</li>
            <li class="wichtig">Sauberkeit</li>
        </ul>
    </section>
    <section id="abschied">
        <h1>Wir freuen uns auf Ihren Besuch!</h1><br><br>
    </section>
@endsection


@section('footer')
        <li><p> &copy; E-Mensa GmbH</p></li>
        <li><p> Haider Abbas und Yannik Sinthern</p></li>
        <li><a href="#impressum">Impressum</a></li>
@endsection
