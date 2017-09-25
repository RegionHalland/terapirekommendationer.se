<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/terapirekommendationer/assets/dist/css/app.dev.css">
</head>
<body>
    <main class="main" role="main">
            @foreach($chapters as $key=>$chapter)
                <div class="section" id="{{$key+1}}">
                    <h1>{{$chapter->post_title}}</h1>
                    <div class="chapter-header"></div>
                    @foreach($chapter->children as $k=>$children)
                        <h2 id="{{$key+1}}.{{$k+1}}">{{$children->post_title}}</h2>
                        {!! apply_filters('the_content', $children->post_content) !!}
                    @endforeach
                </div>
        @endforeach
    </main>
</body>