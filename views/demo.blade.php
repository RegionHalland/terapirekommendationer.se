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
    <script>
        dataLayer = [];
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WZXT8CH');</script>
    <!-- End Google Tag Manager -->
    {!! wp_head() !!}

    <!-- Demo styles -->
    <style type="text/css">
        .demo-header {
            padding: 6rem 1rem;
            text-align: center;
            background: #eee;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .demo-item {
            background: #eee;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 4px;
        }
    </style>
</head>
<body {!! body_class('no-js') !!}>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZXT8CH"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
        @if (isset($notice) && !empty($notice))
            @if (!isset($notice['text']) && is_array($notice))
                @foreach ($notice as $notice)
                    @include('partials.notice')
                @endforeach
            @else
                @include('partials.notice')
            @endif
        @endif


<div class="container main-container mx-auto py3">
    <div class="col col-12 px2">
        <header class="demo-header mb3">
            <h2>Header</h2>
        </header>
    </div>
    <div class="col col-3 px2">
        <div class="demo-item">
            @include('partials.sidebar-left')
        </div>
    </div>

        <div class="col col-6 px2 mb3" id="readspeaker-read">
            <div class="demo-item">
                @if (is_active_sidebar('content-area-top'))
                    <div class="grid sidebar-content-area sidebar-content-area-top">
                        <?php dynamic_sidebar('content-area-top'); ?>
                    </div>
                @endif

                @while(have_posts())
                    {!! the_post() !!}

                    @include('partials.article')
                @endwhile

                @if (is_active_sidebar('content-area'))
                    <div class="grid sidebar-content-area sidebar-content-area-bottom">
                        <?php dynamic_sidebar('content-area'); ?>
                    </div>
                @endif

                <div class="hidden-xs hidden-sm hidden-md hidden-print">
                    @include('partials.page-footer')
                </div>
            </div>
        </div>

        <div class="col col-3 px2">
            <div class="demo-item">
                @include('partials.sidebar-right')
            </div>
        </div>
        
        <div class="col col-12 px2">
            <div class="demo-item">
                @include('partials.page-footer')
            </div>
        </div>
    </div>
</div>


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