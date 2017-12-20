<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<title>Rekommenderade läkemedel</title>
	<link rel="stylesheet" type="text/css" href="{{ get_stylesheet_directory_uri() }}/assets/dist/css/print-rek.min.css">
</head>
<body>
	<h3 class="table-of-contents__header">Rekommenderade läkemedel</h3>
	<ul class="table-of-contents">
		@foreach($lists as $key => $list)
			<li class="table-of-contents__chapter">{{ $list->parent_title }}<a href="#{{$key+1}}"></a></li>
		@endforeach
	</ul> 
	@foreach($lists as $key => $list)
		<div class="list" id="{{$key+1}}">
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

		// Remove last row in tables
		var lists = $('.list tbody');
		for (i = 0; i < lists.length; i++) {
			var item = lists[i];
			item.removeChild(item.lastElementChild);
		}

		// Change subheaders to headers
		$.each($('table'), function(index, value) {
			var subheader = $(this).find('tbody tr:first');
			var text = subheader.text();
			var header = $(this).find('thead td');

			subheader.remove();			
			header.text(text);
		})
	</script>
</body>