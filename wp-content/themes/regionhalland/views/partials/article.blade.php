<?php global $post; ?>
<article id="main" class="article">
    <h1>{{ the_title() }}</h1>

    <div class="col col-12 mb3">
    	<svg class="icon">
    		<use href="#print">	
    	</svg>
    	<a href="#" onclick="window.print(); return false;" class="h5">Skriv ut</a>
    </div>


    @if (get_field('post_single_show_featured_image') === true)
        <img src="{{ regionhalland_get_thumbnail_source(null, array(700,700)) }}" alt="{{ the_title() }}">
    @endif
        
    {!! the_content() !!}

</article>
