(function($, _){

    // When image is edited
    wp.media.events.on('editor:image-edit', function(data) {
        // Check if image has class 'column-span-all' and set the checkbox accordingly
        data.metadata.my_setting = data.editor.dom.hasClass(data.image, 'column-span-all')
    });
    
    // When image is updated
    wp.media.events.on('editor:image-update', function(data) {
        // Add class or remove 'column-span-all' to the image
        if (data.metadata.my_setting) {
            data.editor.dom.addClass(data.image, 'column-span-all')
        } else {
            data.editor.dom.removeClass(data.image, 'column-span-all')
        }
    });

}(jQuery, _));