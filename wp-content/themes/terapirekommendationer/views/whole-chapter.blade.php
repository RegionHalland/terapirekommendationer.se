<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ get_stylesheet_directory_uri() }}/assets/dist/css/print.min.css">
</head>
<body>
   <h2 class="table-of-contents__header">Innehållsförteckning</h2>
    <ul class="table-of-contents">
        @foreach($chapters as $key => $chapter)
            <li class="table-of-contents__chapter">{{$chapter->post_title}}<a href="#{{$key+1}}"></a></li>
            @foreach($chapter->children as $k => $children)
                <li class="table-of-contents__subchapter">{{$children->post_title}}<a href="#{{$key+1}}.{{$k+1}}"></a></li>
            @endforeach
        @endforeach
    </ul> 
    <main class="main" role="main">
            @foreach($chapters as $key=>$chapter)
                <div class="section" id="{{$key+1}}">
                    <h1>{{$chapter->post_title}}</h1>
                    <div class="chapter-header">1</div>
                    @foreach($chapter->children as $k=>$children)
                        <h2 id="{{$key+1}}.{{$k+1}}">{{$children->post_title}}</h2>
                        {!! apply_filters('the_content', $children->post_content) !!}
                    @endforeach
                </div>
        @endforeach
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Remove headings over "Rekommenderade läkemedel" tables
        var headings = $('h2:contains("Rekommenderade läkemedel")');
        headings.remove();
    </script>
 {{--    <main class="main" style="padding: 24pt;" role="main">
        <h1>Kapitel 1 · Sjukdomsförebyggande metoder/ levnadsvanor</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. <a href="http://aftonbladet.se">Länk till aftonbladet.se</a>. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <h2>Allergi hos barn och ungdomar</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <h3>Inledning</h3>
        <p>Allergiska symtom och astma är vanligt förekommande i barn- och ungdomsåren och kräver betydande sjukvårdsin- satser på såväl sjukhus som inom primärvården.</p>
        <p>Svenska undersökningar har visat att 7-10 % av alla barn har astma och 15-20 % kan under de första levnadsåren få bronk-obstruktiva symtom i anslutning till luftvägsinfektioner.</p>
        <p>Cirka 5 % av alla 7-åringar är pollenallergiska med sym- tom från näsa/ögon. Det talet stiger till 10 % för 14-åringar och till 15 % för unga vuxna. För pälsdjursallergi är motsvarande tal 5-10 %.</p>
        <p>Cirka 15-20 % av alla barn har eksem under kortare eller längre tid. Eftersom dessa besvär är så vanliga är det nödvändigt att flertalet patienter på ett tillfredsställande sätt tas om hand i primärvården. Endast en mindre del kan få sin vård på nå- gon av länets barn- och ungdomsmottagningar eller på de speciella barn- och ungdomsallergimottagningar som finns i länet.</p>
        <h4>Patientinformation</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <table class="table">
        <thead class="table__header">
        <tr>
        <td colspan="4">Best animals</td>
        </tr>
        </thead>
        <tbody>
        <tr class="table__subheader">
        <td colspan="4">The best animals of the animal kingdom</td>
        </tr>
        <tr>
        <td>Animal</td>
        <td>Strength</td>
        <td>Agility</td>
        <td>Best Factor</td>
        </tr>
        <tr>
        <td>Bear</td>
        <td>10</td>
        <td>4</td>
        <td>8</td>
        </tr>
        <tr>
        <td>Tiger</td>
        <td>10</td>
        <td>8</td>
        <td>9</td>
        </tr>
        <tr>
        <td>Lion</td>
        <td>10</td>
        <td>10</td>
        <td>10</td>
        </tr>
        <tr>
        <td>Owl</td>
        <td>10</td>
        <td>10</td>
        <td>10</td>
        </tr>
        <tr>
        <td>Snake</td>
        <td>9</td>
        <td>10</td>
        <td>7</td>
        </tr>
        </tbody>
        </table>
        <h5>Förskrivning</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <h5>Huvudbudskapet är:</h5>
        <ul>
            <li><strong>Mometason</strong> nässpray är godkänt för behandling av slemhinnesvullnad i näsan vid akuta episoder av rinosinuit hos vuxna med hyperreaktiva slemhinnor eller intolerans mot vasokonstriktiva nässprayer.</li>
            <li>Vid enbart besvärande rinnsnuva – prova <strong>ipratropium</strong> (<strong>Atrovent Nasal</strong>).</li>
            <li><strong>Mometason</strong> nässpray är godkänt för behandling av slemhinnesvullnad i näsan vid akuta episoder av rinosinuit hos vuxna med hyperreaktiva slemhinnor eller intolerans mot vasokonstriktiva nässprayer.</li>
            <li>Vid enbart besvärande rinnsnuva – prova <strong>ipratropium</strong> (<strong>Atrovent Nasal</strong>).</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="infobox--border">
            <p><strong>Definition av ohälsosamma matvanor utifrån kostindex</strong></p>
            <p><a href="http://www.regionhalland.se/PageFiles/37163/Region%20Hallands%20fr%C3%A5geformul%C3%A4r%20f%C3%B6r%20levnadsvanor.pdf">Region Hallands frågeformulär för levnadsvanor (direktlänk)</a></p>
            <p><a href="http://www.regionhalland.se/PageFiles/37163/Region%20Hallands%20fr%C3%A5geformul%C3%A4r%20f%C3%B6r%20levnadsvanor_enkel%20version%20f%C3%B6r%20utskrift_okt.pdf">Region Hallands frågeformulär för levnadsvanor (enkel version för utskrift)</a></p>
            <p><a href="http://www.regionhalland.se/sidhuvud/bestall-ladda-ner/vard-och-halsa1/informationsfoldrar/goda-levnadsvanor/region-hallands-frageformular-for-levnadsvanor">Region Hallands frågeformulär för levnadsvanor (för beställning)</a></p>
            <p>0-4 poäng = ohälsosamma matvanor<br>
            5-8 poäng = förbättringspotential för bättre matvanor<br>
            9-12 poäng = patienten följer i stort sett kostråden</p>
            <p><a href="http://www.regionhalland.se/PageFiles/68163/Region%20Hallands%20fr%C3%A5geformul%C3%A4r%20f%C3%B6r%20levnadsvanor%20-%20st%C3%B6d%20f%C3%B6r%20tolkning_slutlig%20141219.pdf">Region Hallands frågeformulär för levnadsvanor – stöd för tolkning</a></p>
            <p><a href="http://www.socialstyrelsen.se/nationellariktlinjerforsjukdomsforebyggandemetoder/Documents/nr-sjukdomsforebyggande-inikatorer.pdf">Nationella riktlinjer för sjukdomsförebyggande metoder 2011</a></p>
        </div>
        <ul>
            <li><strong>Mometason</strong> nässpray är godkänt för behandling av slemhinnesvullnad i näsan vid akuta episoder av rinosinuit hos vuxna med hyperreaktiva slemhinnor eller intolerans mot vasokonstriktiva nässprayer.</li>
            <li>Vid enbart besvärande rinnsnuva – prova <strong>ipratropium</strong> (<strong>Atrovent Nasal</strong>).</li>
            <li><strong>Mometason</strong> nässpray är godkänt för behandling av slemhinnesvullnad i näsan vid akuta episoder av rinosinuit hos vuxna med hyperreaktiva slemhinnor eller intolerans mot vasokonstriktiva nässprayer.</li>
            <li>Vid enbart besvärande rinnsnuva – prova <strong>ipratropium</strong> (<strong>Atrovent Nasal</strong>).</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="infobox--background">
            <h6 id="halso-och-sjukvarden-bor"><strong>Hälso- och</strong> sjukvården<strong> bör:</strong></h6>
            <ul>
                <li>Erbjuda kvalificerat rådgivande samtal till personer med ohälsosamma matvanor (prioritet 3).</li>
            </ul>
        </div>
    </main> --}}
</body>