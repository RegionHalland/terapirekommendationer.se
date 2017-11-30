<?php do_action('customer-feedback'); ?>

	@if (get_field('post_show_share', get_the_id()) !== false && get_field('page_show_share', 'option') !== false)
		<svg class="icon">
			<use xlink:href="#share"/>
		</svg>
	    <strong><?php _e('Share the page', 'regionhalland'); ?>:</strong> {{ the_title() }}
	                    @include('partials.social-share')
	@endif
	<div>
        @include('partials.timestamps')
    </div>
