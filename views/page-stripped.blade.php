@extends('templates.stripped')

@section('content')
   
    <div class="container mx-auto px3 py4">
        <div class="clearfix mxn3">

            <div class="mx-auto col-12 sm-col-10 md-col-6 px3 center">

                    <img class="header__logo mb3 mx-auto" src="{{ get_stylesheet_directory_uri() . '/assets/dist/img/region-halland-logo.svg'}}">

                    @while(have_posts())
                        {!! the_post() !!}
                        <article class="article mb2 left-align">
                            <h1 class="center">{{ the_title() }}</h1>
                            {!! the_content() !!}
                        </article>
                    @endwhile
                

                    @if (is_active_sidebar('content-area'))
                        <?php dynamic_sidebar('content-area'); ?>
                    @endif

                    <a class="btn btn-primary" href="/terapirek">Till Terapirekommendationerna</a>
            </div>

        </div>
    </div>

@stop
