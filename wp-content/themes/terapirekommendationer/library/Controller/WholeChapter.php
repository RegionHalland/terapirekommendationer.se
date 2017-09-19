<?php

namespace Terapirekommendationer\Controller;

use PrinceXMLPhp\PrinceWrapper;
use Philo\Blade\Blade;

/**
 * To add a custom template and load it's controller do the following:
 *
 * 1. Create a view file inside the /views directory (example: custom-template-view.blade.php)
 * 2. Create a controller file inside library/Controller (example: name it CustomTemplateView.php and name the class CustomTemplateView)
 * 3. Initialize your template and view by calling the below function (preferabily from a /library/Theme/xxxx.php class)
 *    \Municipio\Helper\Template::add(__('Custom template', 'municipio'), \Municipio\Helper\Template::locateTemplate('custom-template-view.blade.php'));
 */

class WholeChapter extends \Municipio\Controller\BaseController
{
    public function init()
    {
    	//var_dump(expression)
    	//$blade = New View();
    	//return $blade('whole-chapter', ['name' => 'James']);
    	$page_id = 3913;
    	/*$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    //'p' => 473,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );*/

		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			'child_of' => 0,
			'parent' => $page_id,
		);
		$pages = get_pages($args);

		foreach ($pages as $key => $children) {
			$argsTwo = array(
				'sort_order' => 'asc',
				'sort_column' => 'menu_order',
				'parent' => 183,
			);
			$pages[$key]->children = get_pages($argsTwo);

			/*foreach ($pages[$key]->children as $k => $grand) {
				# code...
				//echo json_encode($grand);
				$argsThree = array(
					'sort_order' => 'asc',
					'sort_column' => 'menu_order',
					'parent' => $grand->ID,
				);

				$grand->grand_children = get_pages($argsThree);
			}
			//wp_die();
			//wp_die(json_encode($children));
			/*foreach ($variable as $key => $value) {
				# code...
			}*/
			/*$argsThree = array(
				'sort_order' => 'asc',
				'sort_column' => 'menu_order',
				'parent' => $child->ID,
			);*/

			//$pages[$key]->hello =

			/*foreach ($child as $k => $grand_child) {
				$argsThree = array(
					'sort_order' => 'asc',
					'sort_column' => 'menu_order',
					'parent' => $child->ID,
				);

				echo get_pages($argsThree);

				//$child[$k]->grand_children = get_pages($argsThree);
			}*/

		}

		//var_dump($pages[0]->children[2]->grand_children);


		//$pages->children = get_page_children($portfolio->ID, $pages);

	/*$myArr = array(
		"chapters" => $pages,
		"chapter_children" => $chapter_children,
		"chapter_grand_children" => $pages
	);*/
		//print_r($pages);

		//die()

		$views = __DIR__;
		$cache = __DIR__;
    	$blade = new Blade($views, $cache);
    	
    	//$myString = $blade->view()->make('print', ["chapters" => $pages])->render();
    	//die();




    	$prince = new PrinceWrapper('/usr/bin/prince');
    	$prince->addStyleSheet(__DIR__.'/min.css');
		$err = [];
		$prince->convert_string_to_file('    <main class="main" role="main">
                    <div class="section" id="1">
                <h1>Sjukdomsförebyggande metoder/levnadsvanor</h1>
                <p>I det sjukdomsförebyggande och hälsofrämjande arbetet ingår att stödja människor att göra hälsosamma val och ta ansvar för sin egen hälsa. Det hälsofrämjande förhållnings- sättet i samtalet utgör ett av de viktigaste redskapen. Arbets- sättet ska vara integrerat i patientmötet med stöd av Natio- nella riktlinjer för sjukdomsförebyggande metoder.</p>
<p><img class="alignnone wp-image-4365" src="http://tr.app/wp-content/uploads/2017/04/skacc88rmavbild-2017-09-12-kl-13-55-54.png" alt="" width="434" height="299" /></p>
<p>I flertalet av de övriga kapitlen i Terapirekommendationerna tas specifika råd upp för respektive diagnosområde. Vid vissa tillstånd och situationer har Socialstyrelsen gjort en särskild bedömning av svårighetsgraden. Det gäller inför operation, vid graviditet, vid amning och när man är förälder, samt högrisk- grupperna se regional vårdriktlinje sjukdomsförebyggande ar- bete (sök rutin: Sjukdomsförebyggande arbete/levnadsvanor).</p>

                <div class="chapter-header"></div>
                    
                                            <h2 id="1.1">Tobak</h2>
                        <p>Att undvika rökning är den mest hälsofrämjande åtgärden som en person kan göra. En del studier i de nordiska länderna visar att självrapporterad tobakskonsumtion visar en god överensstämmelse med den konsumtion som kan mätas i biologiska markörer.</p>
<h6>Hälso- och sjukvården bör</h6>
<ul>
<li>Erbjuda kvalicerat rådgivande samtal individuellt eller i grupp till vuxna personer som röker (prioritet 2).</li>
<li>Erbjuda rådgivande samtal i form av proaktiv telefon- rådgivning till vuxna personer som röker (prioritet 3). Exempelvis www.slutarokalinjen.se.</li>
<li>Erbjuda rådgivande samtal till gravida som röker (prioritet 1).</li>
<li>Erbjuda kvali cerat rådgivande samtal till ammande (prioritet 1) och till föräldrar och andra vårdnadsha- vare som röker (prioritet 2).</li>
</ul>
<h6>Hälso- och sjukvården kan:</h6>
<ul>
<li>Erbjuda rådgivande samtal med särskild uppföljning till vuxna personer som röker (prioritet 3).</li>
</ul>
<p>Vi vet för lite om det svenska snusets långtidsrisker. Nikotinberoendet hos snusare är sannolikt väl så stort som hos rökare. Snusvanor skall dokumenteras.</p>
<p>E-cigaretter marknadsförs som en metod för att sluta röka samt för användning på platser där rökning är förbjuden. <strong>E-cigarett rekommenderas ej</strong>, se kapitel 3, Rökavvänjning. Dokumenteras i VAS under sökord <strong>Tobaksvanor</strong>. Åtgärd dokumenteras under <strong>Tobaksrådgivning</strong>.</p>
<p>Mer information: <a href="http://www.tobaksfakta.org/">www.tobaksfakta.org/</a> eller www.umo.se/fimpaaa/</p>
<h6 id="tobaksfritt-i-samband-med-operation">Tobaksfritt i samband med operation</h6>
<p>Nationella riktlinjer framhåller vikten av rökfrihet inför operation.</p>
<p>Personer som röker och ska genomgå en operation har en ökad risk att drabbas av komplikationer i samband med operationen, huvudsakligen i form av försämrad sårläkning men också i form av lung- och hjärtkärlkomplikationer. Hälso- och sjukvården kan ge olika typer av rådgivande samtal i syfte att hjälpa personer som ska genomgå operation att sluta röka.</p>
<p>Rökning hos personer som ska genomgå en operation innebär en mycket stor risk och åtgärden kvalificerat rådgivande samtal (med tillägg av nikotinläkemedel) har stor effekt på rökfrihet vid operationstillfället, och på rökfrihet efter 12 månader</p>
<h6>Hälso- och sjukvården bör</h6>
<ul>
<li>Erbjuda kvalificerat rådgivande samtal med tillägg av nikotinläkemedel till personer som röker och ska genomgå en operation (prioritet 1).</li>
</ul>
<h6>Hälso- och sjukvården kan</h6>
<ul>
<li>Erbjuda rådgivande samtal med tillägg av nikotinlä- kemedel till personer som röker och ska genomgå en operation (prioritet 4).</li>
</ul>
<p>En rutin finns som bygger på att närsjukvården särskilt ska uppmärksamma tobaksbruk hos patienten inför operation, informera och erbjuda stöd för tobaksavvänjning. Specialistvården ska fånga upp patientens eventuella tobaksbruk och <strong>säkerställa att patienten fått rätt tobaksavvänjningsstöd</strong>. Eventuellt kan operation bli nödvändig att senarelägga för att ge patienten tid att sluta röka och minska riskerna i och med ingreppet.</p>
<p>Rutin: ”Tobaksfri operation”. Tillämpningsområde Region Halland. Sök på tobaksfri operation på Region Hallands intranät eller extranät.</p>
<p>Se vidare kapitel 3, <em>Rökavvänjning</em>.</p>

                                            <h2 id="1.2">Alkohol</h2>
                        <p>Undersökningar har visat att frågor om alkoholvanor ställs mer sällan i hälso- och sjukvården än frågor kring övriga levnadsvanor. Detta trots att vanliga hälsoproblem som psykiska besvär, sömnstörningar, hjärt-kärlsjukdom, olycksfall, cancer, suicid, leversjukdom och pankreatit kan kopplas till alkohol. Studier visar även på ökad risk för komplikationer vid kirurgi för de med riskbruk. Det bör även tilläggas att dessa studier är under granskning.</p>
<h4 id="riskbruk-av-alkohol">Riskbruk av alkohol</h4>
<p>Individers alkoholkonsumtion kan studeras med avseende på kvantitet, frekvens och variation (dryckesmönster). Kvantitet och frekvens kombineras ofta i ett volymmått, t.ex. mängd per vecka. Intensiv- eller berusningsdrickande, d.v.s. att dricka en större kvantitet vid ett och samma tillfälle, betraktas som en viktig riskfaktor för olycksfall och våld, men diskuteras även alltmer som en riskfaktor för många andra hälsokonsekvenser.</p>
<p>Beräkningar har gjorts att mellan 15-20 % av befolkningen befinner sig i gruppen som har en definierad riskkonsumtion. Vid självrapportering av alkoholkonsumtion används begreppet ”standardglas” (se figur till höger). Observera att ”standardglas” är ett väldigt grovt mått, då alkoholhalten kan variera kraftigt i t.ex. öl.</p>
<h6>Hälso- och sjukvården bör:</h6>
<ul>
<li>Erbjuda rådgivande samtal till vuxna personer med riskbruk av alkohol (prioritet 4).</li>
<li>Erbjuda webb- och datorbaserad rådgivning till vuxna personer med riskbruk av alkohol (prioritet 4). Exempelvis https://alkoholhjalpen.se.</li>
<li>Erbjuda rådgivande samtal till gravida som brukar alkohol (prioritet 2) och till föräldrar och andra vårdnadshavare med riskbruk av alkohol som har späd- eller småbarn (prioritet 3).</li>
</ul>
<h4 id="riskkonsumtion">Riskkonsumtion</h4>
<p>Riskkonsumtion för <strong>kvinnor</strong> definieras som konsumtion av &gt;12 glas per vecka och/eller 1 eller fler intensivdrickartillfällen per månad (mer än 4 standardglas vid samma tillfälle). För <strong>män</strong> utgörs riskkonsumtion av &gt;14 glas per vecka och/eller 1 eller fler intensivdrickartillfällen per månad (5 glas eller mer vid samma tillfälle). Även lägre konsumtion av alkohol kan innebära risker, t.ex. vid vissa sjukdomar, graviditet eller samtidig användning av vissa läkemedel.</p>
<div id="attachment_5997" style="width: 955px" class="wp-caption alignnone"><img class="wp-image-5997 size-full" src="http://cms.terapirekommendationer.se/wp-content/uploads/2017/04/Bild.png" alt="Med ett ”standardglas” menas" width="945" height="460" /><p class="wp-caption-text">Med ett ”standardglas” menas</p></div>
<ul>
<li>Dokumenteras i VAS under sökord <strong>Alkoholvanor</strong>. Åtgärd dokumenteras under <strong>Alkoholrådgivning</strong>.</li>
<li>Bedömningsstöd AUDIT: <a href="http://www.regionhalland.se/sv/sidhuvud/bestall-ladda-ner/for-vardgivare/levnadsvanor/" target="_blank" rel="noopener">www.regionhalland.se/sv/sidhuvud/bestall-ladda-ner/for-vardgivare/levnadsvanor/ </a></li>
<li>Interaktivt stöd för patienter och <strong>anhöriga</strong> se <a href="https://alkoholhjalpen.se/">https://alkoholhjalpen.se/ </a></li>
<li><strong>Se vidare kapitel 19, Alkohol och drogproblem.</strong></li>
</ul>', './tr.pdf', $err);
		var_dump($err);

    	die();
    	//var_dump(Blade);
		//echo $blade->view()->make('print', ['name' => 'James'])->render();

    	//return \Illuminate::view('whole-chapter', ['name' => 'James']);

    	/*$book = "";
    	$page_id = 3913;
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    //'p' => 473,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );

		/*foreach ($parent->posts as $key => $post) {
			$book = boo $post->post_title;
		}
		
		echo $book;
		die();


		$prince = new PrinceWrapper('/usr/bin/prince');
		$err = [];
		$prince->convert_string_to_file('', './tr.pdf', $err);
		var_dump($err);

		/* DO NOT REMOVE */
		//die();
    }


    public function getChapters(){
    	/*$page_id = get_the_id();
    	
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );
    	return $parent;*/
    }
}
