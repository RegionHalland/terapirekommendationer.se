

@php
    get_the_author_meta('first_name', $author_id);
@endphp


@if (is_array(get_field('show_date_published','option')) && in_array(get_post_type(get_the_id()), get_field('show_date_published','option')))
        | <strong><?php _e("Publicerad", 'regionhalland'); ?>:</strong>
        <time datetime="<?php echo the_time('Y-m-d H:i'); ?>">
            <?php the_modified_time('j F Y'); ?> {!! __("kl.", 'regionhalland'); !!} <?php the_modified_time('H:i'); ?>
        </time>
@endif
