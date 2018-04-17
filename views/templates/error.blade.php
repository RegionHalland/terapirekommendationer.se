<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ get_bloginfo('name') }}</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=yes">
    <meta name="HandheldFriendly" content="true" />

    <meta name="google-translate-customization" content="10edc883cb199c91-cbfc59690263b16d-gf15574b8983c6459-12">

    <script>
        var ajaxurl = '{!! admin_url('admin-ajax.php') !!}';
    </script>

    {!! wp_head() !!}
</head>
<body {!! body_class() !!}>
        @include('partials.stripe')

            {!! regionhalland_get_logotype(!empty(get_field('404_error_logotype', 'options')) ? get_field('404_error_logotype', 'options') : 'standard')  !!}

        @yield('content')

    {!! wp_footer() !!}

</body>
</html>
