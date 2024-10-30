///////Js for uploading image
var imtah_animation1_uploadButton = document.getElementById( 'imtah_animation1_upload_image_button' );
var imtah_animation1_img = document.getElementById( 'imtah_animation1_image-preview' );
var imtah_animation1_image_attachment_id = document.getElementById('imtah_animation1_image_attachment_id')

var imtah_animation1_customUploader = wp.media({
    title: 'Select an Image',
    button: {
        text: 'Use this Image'
    },
    multiple: false
});

imtah_animation1_uploadButton.addEventListener( 'click', function() {

    if ( imtah_animation1_customUploader ) {
        imtah_animation1_customUploader.open();
    }
} );

imtah_animation1_customUploader.on( 'select', function() {
    var imtah_attachment = imtah_animation1_customUploader.state().get('selection').first().toJSON();
    imtah_animation1_img.setAttribute( 'src', imtah_attachment.url );
    imtah_animation1_image_attachment_id.setAttribute('value',imtah_attachment.id);
    /////Ajax post for update image option
    var data = {
          'action': 'imtah_A1update_picture',
          'security': frontEndAjaxA1.nonce,
          'imageId': imtah_attachment.id
        };

        jQuery.post(ajaxurl, data, function() {
        //alert('success');
        });
    });