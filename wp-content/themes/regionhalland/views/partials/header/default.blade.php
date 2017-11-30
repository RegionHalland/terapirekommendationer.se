{{ get_search_form() }}

{!!
    wp_nav_menu(array(
        'theme_location' => 'header-tabs-menu',
        'container' => 'nav',
        'container_class' => 'hidden-md hidden-lg hidden-print',
        'container_id' => '',
        'menu_class' => 'navbar nav-center navbar-creamy navbar-creamy-inner-shadow nav-horizontal',
        'menu_id' => 'help-menu-top-bar',
        'echo' => 'echo',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        'depth' => 1,
        'fallback_cb' => '__return_false'
    ));
!!}

@if (get_field('sub_site_title', 'option'))
    <span class="sub-site-title-block hidden-lg hidden-xl">{!! get_field('sub_site_title', 'option') !!}</span>
@endif

@if (get_field('nav_primary_enable', 'option') === true)
    <nav class="navbar navbar-mainmenu hidden-xs hidden-sm hidden-print {{ get_field('header_sticky', 'option') ? 'sticky-scroll' : '' }} {{ is_front_page() && get_field('header_transparent', 'option') ? 'navbar-transparent' : '' }}">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12">
                    {!! $navigation['mainMenu'] !!}
                </div>
            </div>
        </div>
    </nav>

    @if (strlen($navigation['mobileMenu']) > 0)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle nav-toggle-expand {!! apply_filters('RegionHalland/mobile_menu_breakpoint','hidden-md hidden-lg'); !!} hidden-print">
            @include('partials.mobile-menu')
        </nav>
    @endif
@endif
