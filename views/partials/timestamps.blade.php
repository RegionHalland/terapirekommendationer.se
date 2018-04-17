@if (get_field('page_show_author', 'option') !== false && get_field('post_show_author', get_the_id()) !== false && get_the_author())<strong><?php echo apply_filters('RegionHalland/author_display/title', __('Publicerad av', 'regionhalland')); ?>:</strong>
        @if (get_field('page_link_to_author_archive', 'option'))
        <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="post-author post-author-margin-left">
        @else
        @endif
            @if (in_array('author_image', (array)get_field('archive_' . sanitize_title(get_post_type()) . '_post_display_info', 'option')) && get_field('post_show_author_image', get_the_id()) !== false && !empty(get_field('user_profile_picture', 'user_' . get_the_author_meta('ID'))))
                <span class="post-author-image" style="background-image:url('{{ get_field('user_profile_picture', 'user_' . get_the_author_meta('ID')) }}');"><img src="{{ get_field('user_profile_picture', 'user_' . get_the_author_meta('ID')) }}" alt="{{ (!empty(get_the_author_meta('first_name')) && !empty(get_the_author_meta('last_name'))) ? get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name')  : get_the_author() }}"></span>
            @endif

            @if (!empty(get_the_author_meta('first_name')) && !empty(get_the_author_meta('last_name')))
                {!! apply_filters('RegionHalland/author_display/name', get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'), get_the_author_meta('ID')) !!}
            @else
                {!! apply_filters('RegionHalland/author_display/name', get_the_author(), get_the_author_meta('ID')) !!}
            @endif

        @if (get_field('page_link_to_author_archive', 'option'))
        </a>
        @else
        @endif
@endif


@if (is_array(get_field('show_date_published','option')) && in_array(get_post_type(get_the_id()), get_field('show_date_published','option')))
        | <strong><?php _e("Publicerad", 'regionhalland'); ?>:</strong>
        <time datetime="<?php echo the_time('Y-m-d H:i'); ?>">
            <?php the_modified_time('j F Y'); ?> {!! __("kl.", 'regionhalland'); !!} <?php the_modified_time('H:i'); ?>
        </time>
@endif
