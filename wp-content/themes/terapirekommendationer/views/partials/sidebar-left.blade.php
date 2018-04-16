@if ($hasLeftSidebar||$hasRightSidebar)
    @if (is_author())
        @include('partials.author-box')
    @endif

    @if (is_active_sidebar('left-sidebar'))
        <?php dynamic_sidebar('left-sidebar'); ?>
    @endif

    @if (get_field('nav_sub_enable', 'option'))
    {!! $navigation['sidebarMenu'] !!}
    @endif

    <!-- Use right sidebar to the left in small-ish devices -->
    @if (is_active_sidebar('left-sidebar')||$hasRightSidebar)
        <?php dynamic_sidebar('left-sidebar'); ?>
        <?php dynamic_sidebar('right-sidebar'); ?>
    @endif

    @if (is_active_sidebar('left-sidebar-bottom'))
        <?php dynamic_sidebar('left-sidebar-bottom'); ?>
    @endif
@endif
