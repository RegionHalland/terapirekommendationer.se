<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    	h1{

    	}
    	h2{
    		padding-left:1em;
    	}
		h3{
    		padding-left:2em;
    	}
    	h4{
    		padding-left:4em;
    	}
    	h5{
    		padding-left:6em;
    	}
    	h6{
    		padding-left:8em;
    	}
    </style>
</head>
<body>
	@foreach($chapters as $key => $chapter)
		<h1>{{$chapter->post_title}}</h1>
			@foreach($chapter->children as $k => $children)
	    		<h2>Delkapitel - {{$children->post_title}}</h2>
	    		@foreach($children->headings as $k => $heading)
	    			<{{$heading->tagName}}> {{$heading->tagName}} - {{$heading->textContent}}</{{$heading->tagName}}>
	    		@endforeach
			@endforeach
			<hr>
	@endforeach
</body>