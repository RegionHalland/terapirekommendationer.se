@include('partials.header.default')

@include('partials.hero')

@if (is_active_sidebar('top-sidebar'))
    <?php dynamic_sidebar('top-sidebar'); ?>
@endif
