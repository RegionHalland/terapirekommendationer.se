<div class="post-categories-wrapper">
    <?php _e('Categories', 'regionhalland'); ?>:
    @if (has_category())
    {{ the_category() }}
    @else
    <?php _e('No categories', 'regionhalland'); ?>
    @endif
</div>
