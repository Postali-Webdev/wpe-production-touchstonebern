(function() {
    tinymce.PluginManager.add('phone_number_button', function(editor, url) {
        editor.addButton('phone_number_button', {
            text: 'Insert Phone Number',
            icon: 'mce-phone-icon',
            //ajax call that retrieves phone number in functions file
            onclick: function () {
                  jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'get_phone_number',
                        phone_number: '<?php echo $phone_number; ?>'
                    },
                      success: function (response) {
                        //add phone number link element to editor
                        editor.insertContent(`<a title="call touchstone bernays" href="tel:${response}">${response}</a>`);
                    }
                });                
            }
        });
    });
})();