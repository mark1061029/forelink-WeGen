jQuery(function($) {
    $(document).on('click', '.menu-item-settings .kongmenu-row-image-btn', function() {

        var image_frame;
        var image;
        var t = $(this);

        image_frame = wp.media({
            title: 'Upload or Choose from Media Library',
            multiple: false
        });

        image_frame.on('select', function() {
            image = image_frame.state().get('selection').first().toJSON();

            t.parent().find('.kongmenu-row-image-view').html('<img src="' + image.url + '" />');
            t.parent().find('.kongmenu-row-image-id').val(image.id);
            t.closest('label').addClass('has-image');
        });

        image_frame.open();
    });

    $(document).on('click', '.kongmenu-row-remove-image-btn', function() {
        var t = $(this);
        t.parent().find('.kongmenu-row-image-view').html('');
        t.parent().find('.kongmenu-row-image-id').val('');
        t.closest('label').removeClass('has-image');
    });

});