@extends('templates.master')

@section('content')

    @include('partials.breadcrumbs')

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

                @include('partials.page-footer')

            @include('partials.page-footer')

@stop
