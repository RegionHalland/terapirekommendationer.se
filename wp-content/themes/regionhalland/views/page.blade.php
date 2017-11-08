@extends('templates.master')

@section('content')
	
	@include('partials.breadcrumbs')

	@include('partials.sidebar-left')

    @while(have_posts())
	    {!! the_post() !!}

	    @include('partials.article')
	@endwhile
@stop
