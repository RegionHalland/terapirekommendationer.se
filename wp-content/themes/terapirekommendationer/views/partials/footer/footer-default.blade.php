<footer>
    @if (get_field('footer_logotype_vertical_position', 'option') == 'bottom')
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
    @endif

        {{-- ## Footer header befin ## --}}
        @if (get_field('footer_logotype_vertical_position', 'option') == 'top' || !get_field('footer_logotype_vertical_position', 'option'))
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
        @endif
        {{-- ## Footer header end ## --}}

        {{-- ## Footer widget area begin ## --}}
            @if (is_active_sidebar('footer-area'))
                <?php dynamic_sidebar('footer-area'); ?>
            @endif
        {{-- ## Footer widget area end ## --}}

        {{-- ## Footer header begin ## --}}
        @if (get_field('footer_logotype_vertical_position', 'option') == 'bottom' && get_field('footer_logotype', 'option') != 'hide')
                {!! regionhalland_get_logotype(get_field('footer_logotype', 'option')) !!}
                @if(have_rows('footer_icons_repeater', 'option'))
                        @foreach(get_field('footer_icons_repeater', 'option') as $link)
                                <a href="{{ $link['link_url'] }}" target="_blank" class="link-item-light">
                                    {!! $link['link_icon'] !!}

                                    @if (isset($link['link_title']))
                                    <span class="sr-only">{{ $link['link_title'] }}</span>
                                    @endif
                                </a>
                        @endforeach
                @endif
        @endif
        {{-- ## Footer header end ## --}}

        @if (get_field('footer_logotype_vertical_position', 'option') == 'top' && have_rows('footer_icons_repeater', 'option'))
                        @foreach(get_field('footer_icons_repeater', 'option') as $link)
                            <li>
                                <a href="{{ $link['link_url'] }}" target="_blank" class="link-item-light">
                                    {!! $link['link_icon'] !!}

                                    @if (isset($link['link_title']))
                                    <span class="sr-only">{{ $link['link_title'] }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
        @endif

    {{-- ## Footer signature ## --}}
    @if (get_field('footer_signature_show', 'option'))
            {!! apply_filters('RegionHalland/footer_signature', '<a href="http://www.helsingborg.se"><img src="' . get_template_directory_uri() . '/assets/dist/images/helsingborg.svg" alt="Helsingborg Stad" class="footer-signature"></a>') !!}
    @endif
</footer>