<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/terapirekommendationer/assets/dist/css/print.min.css">
</head>
<body>
    <h2 class="table-of-contents__header">Innehållsförteckning</h2>
    <ul class="table-of-contents">
        @foreach($chapters as $key => $chapter)
            <li class="table-of-contents__chapter">{{$chapter->post_title}}<a href="#{{$key+1}}"></a></li>
            @foreach($chapter->children as $k => $children)
                <li class="table-of-contents__subchapter">{{$children->post_title}}<a href="#{{$key+1}}.{{$k+1}}"></a></li>
            @endforeach
        @endforeach
    </ul> 
    <main class="main" role="main">
            @foreach($chapters as $key=>$chapter)
                <div class="section" id="{{$key+1}}">
                    <h1>{{$chapter->post_title}}</h1>
                    <div class="chapter-header">1</div>
                    @foreach($chapter->children as $k=>$children)
                        <h2 id="{{$key+1}}.{{$k+1}}">{{$children->post_title}}</h2>
                        {!! apply_filters('the_content', $children->post_content) !!}
                    @endforeach
                </div>
        @endforeach
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Remove headings over "Rekommenderade läkemedel" tables
        var headings = $('h2:contains("Rekommenderade läkemedel")');
        headings.remove();
    </script>
</body>