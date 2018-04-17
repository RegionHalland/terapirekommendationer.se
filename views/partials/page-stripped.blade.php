@extends('templates.stripped')

@section('content')
   
    <div class="container mx-auto px3 py4">
        <div class="clearfix mxn3">

            <div class="col col-12 md-col-6 px3">

                    @while(have_posts())
                        {!! the_post() !!}
                        <article class="article">
                            <h1>{{ the_title() }}</h1>
                            {!! the_content() !!}
                        </article>
                    @endwhile
                

                    @if (is_active_sidebar('content-area'))
                        <?php dynamic_sidebar('content-area'); ?>
                    @endif

                    <hr>
            </div>

        </div>
    </div>

@stop
