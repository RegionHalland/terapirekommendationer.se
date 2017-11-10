@extends('templates.master')

@section('content')
   
    <div class="container mx-auto py4">
        <div class="clearfix mxn3">

            <div class="col col-3 px3">
                @include('partials.sidebar-left')
            </div>

            <div class="col col-6 px3">
                    @if (is_active_sidebar('content-area-top'))
                        <?php dynamic_sidebar('content-area-top'); ?>
                    @endif

                    @while(have_posts())
                        {!! the_post() !!}
                        @include('partials.article', ['main' => true])
                    @endwhile

                    @if (is_active_sidebar('content-area'))
                        <?php dynamic_sidebar('content-area'); ?>
                    @endif

                    <hr>
                    
                    <div class="col col-12 px3">
                        @include('partials.page-footer')
                    </div>
            </div>



            <div class="col col-3 px3 content-nav-wrapper">
                @include('partials.sidebar-right')
                    <nav>
                        <span class="content-nav__heading">Innehållsmeny</span>
                        <ul class="content-nav">
                            <li class="content-nav__item"><a class="content-nav__link" href="#">Behandling</a></li>
                            <li class="content-nav__item active"><a class="content-nav__link" href="#">Kontakt</a></li>
                            <li class="content-nav__item"><a class="content-nav__link" href="#">Hosta</a></li>
                            <li class="content-nav__item"><a class="content-nav__link" href="#">Farliga läkemedel</a></li>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>

@stop
