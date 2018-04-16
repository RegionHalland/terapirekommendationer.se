<div class="post-tags-wrapper">
    <?php _e('Tags', 'regionhalland'); ?>:
    @if (has_tag())
    <ul class="tags tags-white tags">
        {{ the_tags('<li>', '</li><li>', '</li>') }}
    </ul>
    @else
    <?php _e('No tags', 'regionhalland'); ?>
    @endif
</div>
