jQuery(document).ready(function($){

    // Media Uploader
    var mediaUploader;

    $('#upload-button').click(function(e) {
        e.preventDefault();
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#fdm_responsive_menu_optionssite_logo').val(attachment.url);
        });
        // Open the uploader dialog
        mediaUploader.open();
    });

    $('#reset-site-logo-uploader').click(function(){
        $('#fdm_responsive_menu_optionssite_logo').val('');
        $('#logo-image').toggle();
        $('#reset-site-logo-uploader').toggle();
    });

    // Icon Picker
    $(".icp-auto").iconpicker({
        title: true, // Popover title (optional) only if specified in the template
        selected: false, // use this value as the current item and ignore the original
        defaultValue: false, // use this value as the current item if input or element value is empty
        placement: 'bottom', // (has some issues with auto and CSS). auto, top, bottom, left, right
        collision: 'none', // If true, the popover will be repositioned to another position when collapses with the window borders
        animation: true, // fade in/out on show/hide ?
        hideOnSelect: true, //hide iconpicker automatically when a value is picked. it is ignored if mustAccept is not false and the accept button is visible
        showFooter: false,
        searchInFooter: false, // If true, the search will be added to the footer instead of the title
        mustAccept: false, // only applicable when there's an iconpicker-btn-accept button in the popover footer
        //selectedCustomClass: 'bg-primary', // Appends this class when to the selected item
        //icons: [], // list of icon classes (declared at the bottom of this script for maintainability)
        // fullClassFormatter: function(val) {
        //     return 'fa ' + val;
        // },
        //input: 'input,.iconpicker-input', // children input selector
        inputSearch: true, // use the input as a search box too?
        container: false, //  Appends the popover to a specific element. If not set, the selected element or element parent is used
        //component: '.input-group-addon,.iconpicker-component', // children component jQuery selector or object, relative to the container element
        // Plugin templates:
        templates: {
            popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
            '<div class="popover-title" style="text-align: center;">Use input field above to search.</div><div class="popover-content"></div></div>',
            footer: '<div class="popover-footer"></div>',
            buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
            ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Search" />',
            iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
            iconpickerItem: '<a role="button" href="#" class="iconpicker-item"><i></i></a>',
        }
    });

    // Color Picker
    $('.fdm-menu-color-field').wpColorPicker();

});