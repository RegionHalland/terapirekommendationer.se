<ul>
    <li class="inline-block">
        <a class="share-social-mail" data-action="share-popup" href="mailto:?subject=Tips från Terapirekommendationerna&body={!! urlencode(the_permalink()) !!}" data-tooltip="<?php _e('Share on', 'regionhalland'); ?> Mail">
            <span><?php _e('Dela på ', 'regionhalland'); ?> Mail</span>
        </a> |
    </li>
    <li class="inline-block">
        <a class="share-social-facebook" data-action="share-popup" href="https://www.facebook.com/sharer/sharer.php?u={!! urlencode(the_permalink()) !!}" data-tooltip="<?php _e('Share on', 'regionhalland'); ?> Facebook">
            <i class="pricon pricon-facebook"></i>
            <span><?php _e('Dela på ', 'regionhalland'); ?> Facebook</span>
        </a> |
    </li>
    <li class="inline-block">
        <a class="share-social-twitter" data-action="share-popup" href="http://twitter.com/share?url={!! urlencode(the_permalink()) !!}" data-tooltip="<?php _e('Share on', 'regionhalland'); ?> Twitter">
            <i class="pricon pricon-twitter"></i>
            <span><?php _e('Dela på ', 'regionhalland'); ?> Twitter</span>
        </a> |
    </li>
    <li class="inline-block">
        <a class="share-social-linkedin" data-action="share-popup" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={!! urlencode(the_permalink()) !!}&amp;title={{ urlencode(get_the_title()) }}" data-tooltip="<?php _e('Share on', 'regionhalland'); ?> LinkedIn">
            <i class="pricon pricon-linkedin"></i>
            <span><?php _e('Dela på ', 'regionhalland'); ?> LinkedIn</span>
        </a>
    </li>
</ul>
