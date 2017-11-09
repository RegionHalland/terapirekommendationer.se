@extends('templates.master')

@section('content')

    @include('partials.breadcrumbs')

        @include('partials.sidebar-left')

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

    @include('partials.sidebar-right')

    @include('partials.page-footer')

@stop
