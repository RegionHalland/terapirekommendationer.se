<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ get_stylesheet_directory_uri() }}/assets/dist/css/print.min.css">
</head>
<body>
	<h2 class="table-of-contents__header">Rekommenderade läkemedel</h2>
    <ul class="table-of-contents">
        @foreach($lists as $key => $list)
            <li class="table-of-contents__chapter">{{ $list->parent_title }}<a href="#{{$key+1}}"></a></li>
        @endforeach
    </ul> 
    @foreach($lists as $key => $list)
        <div class="table-of-contents__subchapter">
        	{!! apply_filters('the_content', $list->post_content) !!}
        </div>
    @endforeach
</body>