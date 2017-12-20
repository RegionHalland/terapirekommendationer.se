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
            <li class="table-of-contents__chapter">{{ $list->heading }}<a href="#{{$key+1}}"></a></li>
        @endforeach
    </ul> 
    @foreach($lists as $key => $list)
        <div class="list" id="{{$key+1}}">
            {!! apply_filters('the_content', $list) !!}
        </div>
    @endforeach
</body>