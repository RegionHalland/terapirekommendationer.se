@extends('templates.master')

@section('content')
   
    <div class="container mx-auto px3 py4">
        <div class="clearfix mxn3">

            <div class="col col-12 md-col-3 px3">
                @include('partials.sidebar-left')
            </div>

            <div class="col col-12 md-col-6 px3">
                    @if (is_active_sidebar('content-area-top'))
                        <?php dynamic_sidebar('content-area-top'); ?>
                    @endif

                    @while(have_posts())
                        {!! the_post() !!}
                        @include('partials.article')
                    @endwhile

                    @if (is_active_sidebar('content-area'))
                        <?php dynamic_sidebar('content-area'); ?>
                    @endif

                    <hr>
                    
                    <div class="col col-12">
                        @include('partials.page-footer')
                    </div>
            </div>



            <div class="col col-12 md-col-3 px3">
                @include('partials.content-nav')
            </div>
        </div>
    </div>

@stop
