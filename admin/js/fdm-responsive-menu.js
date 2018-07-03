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

    // Copy Shortcode to Clipboard using clipboard.js
    var clipboard = new ClipboardJS('.copy-shortcode'),
        copyComplete = $('#copy-complete');
    copyComplete.hide();

    clipboard.on('success', function(e) {
        copyComplete.fadeIn().delay( 1500 ).fadeOut();
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        //console.error('Action:', e.action);
        //console.error('Trigger:', e.trigger);
    });



    // Add Social Icon Repeater
    $('.add-social-icon-row').on('click', function (e) {

        e.preventDefault();
        var $spanEl = $('.fdm-social-icon:last');
        var $spanElID = $spanEl.attr('id');
        var split_id = $spanElID.split('_');
        var nextindex = Number(split_id[1]) + 1;
        var $klonEl = $spanEl.clone();

        $klonEl.prop('id', 'social-icon-row_'+nextindex );

        var $inputEl = $klonEl.find('input');
        var $iconEl = $klonEl.find('.input-group-addon');
        var $fa = $klonEl.find('i');

        $inputEl.val('');
        $fa.prop('class', 'fa');
        $inputEl.prop('id', 'social-icon-input_'+nextindex ).prop('class', 'form-control icp icp-auto iconpicker-element iconpicker-input').prop('name', 'fdm_responsive_menu_options[fdm_social_icon_'+nextindex+']' );
        var $linkEl = $klonEl.find('input[type=url]');
        $linkEl.val('');
        $linkEl.prop('id', 'social-icon-link_'+nextindex ).prop('class', 'link-input link-input-'+nextindex ).prop('name', 'fdm_responsive_menu_options[fdm_social_link_'+nextindex+']' );

        var $removeEl = '<button id="fdm-remove-row-'+nextindex+'" class="fdm-remove-row" type="button">-</button>';

        if(nextindex === 2){
            $spanEl.after($klonEl);
            $linkEl.after($removeEl);
        } else {
            $spanEl.after($klonEl);
        }

        $('.icp-auto').iconpicker();

    });

    // Add Custom Icon Repeater
    $('.add-custom-link-row').on('click', function (e) {

        e.preventDefault();
        var $spanEl = $('.fdm-custom-icon-link:last');
        var $spanElID = $spanEl.attr('id');
        var split_id = $spanElID.split('_');
        var nextindex = Number(split_id[1]) + 1;
        var $klonEl = $spanEl.clone();

        $klonEl.prop('id', 'custom-icon-row_'+nextindex );

        var $inputEl = $klonEl.find('.choose-icon');
        var $iconEl = $klonEl.find('.input-group-addon');
        var $customLinkInputEl = $klonEl.find('.custom-link-input');
        var $customTextInputEl = $klonEl.find('.custom-icon-link-text');
        var $fa = $klonEl.find('i');


        $inputEl.val('');
        $customLinkInputEl.val('');
        $customTextInputEl.val('');

        $fa.prop('class', 'fa');
        $inputEl.prop('id', 'custom-icon-input_'+nextindex ).prop('class', 'form-control icp icp-auto iconpicker-element iconpicker-input').prop('name', 'fdm_responsive_menu_options[fdm_custom_link_icon_'+nextindex+']' );

        $customLinkInputEl.prop('id', 'custom-icon-link_'+nextindex ).prop('class', 'custom-link-input custom-link-input-'+nextindex ).prop('name', 'fdm_responsive_menu_options[fdm_custom_link_'+nextindex+']' );

        $customTextInputEl.prop('id', 'custom-icon-link-text_'+nextindex).prop('class', 'custom-icon-link-text custom-icon-link-text-'+nextindex).prop('name', 'fdm_responsive_menu_options[fdm_custom_link_text_'+nextindex+']' );


        var $removeEl = '<button id="fdm-remove-row-'+nextindex+'" class="fdm-remove-row" type="button">-</button>';

        if(nextindex === 2){
            $spanEl.after($klonEl);
            $customTextInputEl.after($removeEl);
        } else {
            $spanEl.after($klonEl);
        }

        $('.icp-auto').iconpicker();

        //console.log($customTextInputEl);

    });
    //Remove Repeating Row
    $('.fdm_responsive_menu_rows').on('click', '.fdm-remove-row', function (e) {
        e.preventDefault();
        $(this).parent().remove();
        $(this).remove();
        //console.log($(this).parent().innerHTML);

    });
});