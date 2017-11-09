{!! regionhalland_get_logotype('standard') !!}

@include('partials.header.' . $headerLayout['template'])

@include('partials.hero')

@if (is_active_sidebar('top-sidebar'))
    <?php dynamic_sidebar('top-sidebar'); ?>
@endif
