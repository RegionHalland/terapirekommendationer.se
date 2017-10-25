(function($, _){

    // When image is edited
    wp.media.events.on('editor:image-edit', function(data) {
        // Check if image has class 'column-span-all' and set the checkbox accordingly
        parent = $(data.image).parents('figure')[0];
        data.metadata.my_setting = data.editor.dom.hasClass(parent, 'column-span-all')
    });
    
    // When image is updated
    wp.media.events.on('editor:image-update', function(data) {
        // Find parent
        parent = $(data.image).parents('figure')[0];

        // Add class or remove 'column-span-all' to the image
        if (data.metadata.my_setting) {
            data.editor.dom.addClass(parent, 'column-span-all')
        } else {
            data.editor.dom.removeClass(parent, 'column-span-all')
        }
    });

}(jQuery, _));