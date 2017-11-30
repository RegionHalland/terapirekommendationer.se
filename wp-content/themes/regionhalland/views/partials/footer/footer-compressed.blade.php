<footer>
    @if (get_field('footer_logotype', 'option') != 'hide')
    {!! regionhalland_get_logotype(get_field('footer_logotype', 'option')) !!}
    @endif

            {!!
                wp_nav_menu(array(
                    'theme_location' => 'help-menu',
                    'container' => false,
                    'container_class' => 'menu-{menu-slug}-container',
                    'container_id' => '',
                    'menu_class' => '',
                    'menu_id' => 'help-menu-top',
                    'echo' => false,
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '%3$s',
                    'depth' => 1,
                    'fallback_cb' => '__return_false'
                ));
            !!}

    @if(have_rows('footer_icons_repeater', 'option'))
            @foreach(get_field('footer_icons_repeater', 'option') as $link)
                    <a href="{{ $link['link_url'] }}" target="_blank">
                        {!! $link['link_icon'] !!}

                        @if (isset($link['link_title']))
                        <span>{{ $link['link_title'] }}</span>
                        @endif
                    </a>
            @endforeach
    @endif

    @if (is_active_sidebar('footer-area'))
        <?php dynamic_sidebar('footer-area'); ?>
    @endif
    </div>

    {{-- ## Footer signature ## --}}
    @if (get_field('footer_signature_show', 'option'))
        {!! apply_filters('RegionHalland/footer_signature', '<a href="#"></a>') !!}
    @endif
</footer>