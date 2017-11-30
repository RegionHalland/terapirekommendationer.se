<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo apply_filters('RegionHalland/pageTitle', wp_title('|', false, 'right') . get_bloginfo('name')); ?></title>

    <meta name="description" content="{{ bloginfo('description') }}" />
    <meta name="pubdate" content="{{ the_time('Y-m-d') }}">
    <meta name="moddate" content="{{ the_modified_time('Y-m-d') }}">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=yes">
    <meta name="HandheldFriendly" content="true" />

    <script>
        var ajaxurl = '{!! apply_filters('RegionHalland/ajax_url_in_head', admin_url('admin-ajax.php')) !!}';
    </script>

    {!! wp_head() !!}
</head>
<body {!! body_class('no-js') !!}>
        @if (isset($notice) && !empty($notice))
            @if (!isset($notice['text']) && is_array($notice))
                @foreach ($notice as $notice)
                    @include('partials.notice')
                @endforeach
            @else
                @include('partials.notice')
            @endif
        @endif

            @include('partials.header')

            @yield('content')

            @if (is_active_sidebar('content-area-bottom'))
                <?php dynamic_sidebar('content-area-bottom'); ?>
            @endif

        <div class="col col-12 px3">
           <!-- @include('partials.footer') -->
        </div>

        <!-- @include('partials.vertical-menu') -->

        @if (in_array(get_field('show_google_translate', 'option'), array('footer', 'fold')))
            @include('partials.translate')
        @endif

    {!! wp_footer() !!}

</body>
</html>
