<?php
/**
* Plugin Name: Kalkulator kalorii
* Plugin URI: https://www.wordpress.pl
* Description: Kalkulator przeliczający zapotrzebowanie kaloryczne
* Version: 1.0
* Author: MAGES Michał Jendraszczyk
* Author URI: https://mages.pl/
*/


function mjwpkalkulatorkcal() {
    
    $output = '';
    $output .= ' <div class="mjwpkalkulatorkcal">
         
    <h1>
        '.__('Kalkulator PPM i CPM').'

    </h1>
    <p>
    '.__('W tym miejscu możesz w łatwy sposób obliczyć swoje zapotrzebowanie kaloryczne. Wystarczy, że uzupełnisz poniższy formularz i wpiszesz poprawnie swoją płeć, wiek, wzrost, masę ciała, stopień aktywności fizycznej i cel diety. Na podstawie Twoich danych wybierzemy odpowiednią dietę dla Ciebie.').'
<p>
'.__('Karmienie piersią: do wyniku dodaj 500kcal.').'
    <br>  
    '.__('Ciąża 1 trymestr: do CPM dodaj 85kcal.').'
    <br>
    '.__('Ciąża 2 trymestr: do CPM dodaj 285kcal.').'
 <br>
 '.__('Ciąża 3 trymestr: do CPM dodaj 475kcal.').'
</p>

    </p>
    <fieldset>
        <legend>
        '.__('Podstawowe informacje').'
        </legend>
    <form>
        
    <div class="row">
    <div class="col-md-6">
        <label for="">
        '.__('Płeć').'
        </label>
        <select name="plec" id="plec" class="form-control">
            <option value="0">'.__('Kobieta').'</option>
            <option value="1">'.__('Męzczyzna').'</option>
        </select>
        </div>

        <div class="col-md-6">
        <label for="">'.__('Wiek').'</label>
        <input type="number" name="wiek" value="30"  class="form-control" id="wiek">
        </div>
        </div>


        <div class="row">
        <div class="col-md-6">

        <label for="">'.__('Wzrost').' [cm]</label>
        <input type="number" name="wzrost" value="165" id="wzrost" class="form-control">
        </div>

        
        <div class="col-md-6">
        <label for="">'.__('Masa').' [kg]</label>
        <input type="number" name="masa" value="80" id="masa" class="form-control">
        </div>
        </div>
         
        <br>
        <div class="row">
        <div class="col-md-12">
        <label for="">'.__('Stopień aktywności').'</label>
        <select name="aktywnosc" id="aktywnosc" class="form-control">
     <option value="1.4">'.__('Siedzący tryb życia, brak aktywności fizycznej, codzienne prace domowe').'</option>
     <option value="1.5">'.__('Niska aktywność fizyczna: praca siedząca, codzienne prace domowe, od 30 – 60 minut umiarkowanej aktywności fizycznej (np. spacer)').'</option>
     <option value="1.7">'.__('Umiarkowana aktywność fizyczna: codzienne prace domowe i 60 minut umiarkowanej aktywności fizycznej (np. bieganie, aerobik, jazda na rowerze, gra w tenisa, taniec) kilka razy w tygodniu lub praca fizyczna').'</option>
     <option value="1.9">'.__('Umiarkowana aktywność fizyczna: codzienne prace domowe i 60 minut codziennej umiarkowanej aktywności fizycznej (np. bieganie, aerobik, jazda na rowerze, gra w tenisa, taniec) lub praca fizyczna').'</option>
     <option value="2.0">'.__('Wysoka aktywność fizyczna: codzienne prace domowe + praca fizyczna + ponad 60 minut codziennej intensywnej aktywności fizycznej').'</option>
     <option value="2.2">'.__('Ekstremalnie wysoka aktywność fizyczna (wyczynowe uprawianie sportu)').'</option>

        </select>
        <label for="">'.__('Cel diety').'</label>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
        <select name="cel" id="cel" class="form-control">
            <option value="-1">'.__('Redukcja masy ciała').'</option>
            <option value="0">'.__('Utrzymanie masy ciała').'</option>
            <option value="1">'.__('Zwiękrzenie masy ciała').'</option>
        </select>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
        <button type="button"  class="btn" style="margin:25px 0;" onclick="obliczmjwpkalkulatorkcal()">
        '.__('Oblicz').'
        </button>
        </div>
        </div>
    </form>
</fieldset>

<div id="content_mjwpkalkulatorkcal"></div>

</div>';

     return $output;
 }

add_shortcode( "mjwpkalkulatorkcal", "mjwpkalkulatorkcal");



function mjwpkalkulatorkcalScript() {
 ?>

<script type="text/javascript">

    function obliczmjwpkalkulatorkcal() {
        var cel = parseFloat(document.getElementById("cel").value);
        var aktywnosc = parseFloat(document.getElementById("aktywnosc").value);
        var masa = parseFloat(document.getElementById("masa").value);
        var wzrost = parseFloat(document.getElementById("wzrost").value);
        var wiek = parseFloat(document.getElementById("wiek").value);
        var plec = parseFloat(document.getElementById("plec").value);
 

 /** 
 Stara wersja 
 */
        // if(plec == 1) { 

        //     var wynik = 66.47 + (13.7*masa) + ((5*wzrost) - (6.76*wiek));
        // } else { 
        //     var wynik = 655.1 + (9.567*masa) + ((1.85*wzrost) - (4.68*wiek));
        // }

        // var wynik = wynik.toFixed();
        // var wynik_cpm = (wynik * aktywnosc).toFixed();


        // if(cel == -1) { 
        //     var wynik_zapotrzebowanie = (0.85*wynik_cpm).toFixed();
        // } else if(cel == 1)  {
        //     var wynik_zapotrzebowanie = (0.85*wynik_cpm).toFixed();
        // } else { 
        //     var wynik_zapotrzebowanie = wynik_cpm;
        // }

/**
Nowa wersja

PPM (kobiety) = (10 x masa ciała [kg])+(6,25 x wzrost [cm])-(5 x [wiek]) – 161

PPM (mężczyźni) = (10 x masa ciała [kg])+(6, 25 x wzrost [cm])-(5 x [wiek]) + 5


1,4 – siedzący tryb życia, brak aktywności fizycznej, codzienne prace domowe
1,5 – 1,6 – niska aktywność fizyczna: praca siedząca, codzienne prace domowe, od 30 – 60 minut umiarkowanej aktywności fizycznej (np. spacer)
1,7- 1,8 – umiarkowana aktywność fizyczna: codzienne prace domowe i 60 minut umiarkowanej aktywności fizycznej (np. bieganie, aerobik, jazda na rowerze, gra w tenisa, taniec) kilka razy w tygodniu lub praca fizyczna
1,9 – 2,0 – umiarkowana aktywność fizyczna: codzienne prace domowe i 60 minut codziennej umiarkowanej aktywności fizycznej (np. bieganie, aerobik, jazda na rowerze, gra w tenisa, taniec) lub praca fizyczna
2,0 – 2,2 – wysoka aktywność fizyczna: codzienne prace domowe + praca fizyczna + ponad 60 minut codziennej intensywnej aktywności fizycznej
2,2 – 2,4 – ekstremalnie wysoka aktywność fizyczna (wyczynowe uprawianie sportu)


 */


// Mezczyzni
if(plec == 1) { 
var wynik = (10 * masa)+(6.25 * wzrost)-(5 * wiek) + 5;
} else { 
//Kobiety
var wynik = (10 * masa)+(6.25 * wzrost)-(5 * wiek) - 161;
//655.1 + (9.567*masa) + ((1.85*wzrost) - (4.68*wiek));
}

var wynik = wynik.toFixed();
var wynik_cpm = (wynik * aktywnosc).toFixed();


if(cel == -1) { 
var wynik_zapotrzebowanie = ((0.85*wynik_cpm) - (0.85*wynik_cpm)*0.1).toFixed();
} else if(cel == 1)  {
var wynik_zapotrzebowanie = ((0.85*wynik_cpm) + (0.85*wynik_cpm)*0.1).toFixed();
} else { 
var wynik_zapotrzebowanie = wynik_cpm;
}
        var zakup_diety = ((wynik_zapotrzebowanie/100)).toFixed()*100;

        var content = `
        <h3>Wyniki zapotrzebowania kcal</h3>
<p>Twoja Podstawowa Przemiana Materii (PPM): </p>
${wynik} kcal
<p>
Podstawowa Przemiana Materii (PPM) to ilość kalorii, jaką potrzebuje Twoje ciało aby podtrzymać podstawowe funkcje życiowe tj. praca narządów czy utrzymanie odpowiedniej temperatury. Jest to dolna granica kaloryczności diety poniżej której nie należy schodzić.
</p>

<p>
Twoja Całkowita Przemiana Materii (CPM): 
</p>
${wynik_cpm} kcal
<p>
Całkowita Przemiana Materii (CPM) to średnia ilość kalorii, jaką potrzebuje Twoje ciało na aktywność w ciągu dnia. W CPM wliczone jest PPM oraz Twoja aktywność zawodowa, treningowa i pozatreningowa. Ważne, by odpowiednio określić swoją aktywność fizyczną.
</p>

Sugerowana dieta
Twoje zapotrzebowanie kaloryczne to: ${wynik_zapotrzebowanie} kcal

Proponuję zakup diety o kaloryczności ${zakup_diety} kcal, którą znajdziesz <a href="#">tutaj</a>.`;

document.getElementById("content_mjwpkalkulatorkcal").innerHTML = content;
    }

</script>

 <?php
}
 add_action('wp_footer', 'mjwpkalkulatorkcalScript');
