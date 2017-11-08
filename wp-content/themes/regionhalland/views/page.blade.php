@extends('templates.master')

@section('content')
	
	@include('partials.breadcrumbs')

    @while(have_posts())
	    {!! the_post() !!}

	    @include('partials.article')
	@endwhile
@stop
