<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Rekommenderade läkemedel</title>
    <link rel="stylesheet" type="text/css" href="{{ get_stylesheet_directory_uri() }}/assets/dist/css/print-rek.min.css">
</head>
<body>
	<h2 class="table-of-contents__header">Rekommenderade läkemedel</h2>
    <ul class="table-of-contents">
        @foreach($lists as $key => $list)
            <li class="table-of-contents__chapter">{{ $list->parent_title }}<a href="#{{$key+1}}"></a></li>
        @endforeach
    </ul> 
    @foreach($lists as $key => $list)
        <div class="list">
        	<h2 id="{{$key+1}}">{{ $list->parent_title }}</h2>
        	{!! apply_filters('the_content', $list->post_content) !!}
        </div>
    @endforeach

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		// Make :contains case insensitive
		$.expr[":"].contains = $.expr.createPseudo(function(arg) {
			return function( elem ) {
		    	return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
			};
		});

        // Remove headings over "Rekommenderade läkemedel" tables
        var headings = $('thead:contains("rekommenderade")');
        headings.remove();

        // Remove last row in tables
        console.log($('.list tbody tr:last'))
        var tableFooters = $('.list tbody tr:last');
        tableFooters.remove();
    </script>
</body>