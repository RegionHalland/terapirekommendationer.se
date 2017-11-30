@extends('templates.master')

@section('content')

<h1>404</h1>
{{ get_field('404_error_message', 'option') ? get_field('404_error_message', 'option') : 'The page could not be found' }}
<!--
<h1>{{ get_field('404_error_message', 'option') ? get_field('404_error_message', 'option') : 'The page could not be found' }}</h1>
<h4 style="margin-top:0;"><?php _e('Error 404', 'regionhalland'); ?></h4>
-->

{!! get_field('404_error_info', 'option') ? get_field('404_error_info', 'option') : '' !!}

@if (is_array(get_field('404_display', 'option')) && in_array('search', get_field('404_display', 'option')))
    <a rel="nofollow" href="{{ home_url() }}?s={{ $keyword }}"">{{ sprintf(get_field('404_display', 'option') ? get_field('404_search_link_text', 'option') : 'Search "%s"', $keyword) }}</a>
@endif

@if (is_array(get_field('404_display', 'option')) && in_array('home', get_field('404_display', 'option')))
<li><a href="{{ home_url() }}"">{{ get_field('404_home_link_text', 'option') ? get_field('404_home_link_text', 'option') : 'Go to home' }}</a></li>
@endif

@if (is_array(get_field('404_display', 'option')) && in_array('back', get_field('404_display', 'option')))
<li><a href="javascript:history.go(-1);">{{ get_field('404_back_button_text', 'option') ? get_field('404_back_button_text', 'option') : 'Go back' }}</a></li>
@endif

@stop
