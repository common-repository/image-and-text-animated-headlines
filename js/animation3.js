///////Js for uploading image
////////Image1
var imtah_animation3_uploadButton1 = document.getElementById( 'imtah_animation3_upload_image_button1' );
var imtah_animation3_img1 = document.getElementById( 'imtah_animation3_image-preview1' );
var imtah_animation3_image_attachment_id1 = document.getElementById('imtah_animation3_image_attachment_id1')

var imtah_animation3_customUploader1 = wp.media({
    title: 'Select an Image',
    button: {
        text: 'Use this Image'
    },
    multiple: false
});

imtah_animation3_uploadButton1.addEventListener( 'click', function() {

    if ( imtah_animation3_customUploader1 ) {
        imtah_animation3_customUploader1.open();
    }
} );

imtah_animation3_customUploader1.on( 'select', function() {
    var imtah_attachmentA1 = imtah_animation3_customUploader1.state().get('selection').first().toJSON();
    imtah_animation3_img1.setAttribute( 'src', imtah_attachmentA1.url );
    imtah_animation3_image_attachment_id1.setAttribute('value',imtah_attachmentA1.id);
    var data = {
          'action': 'imtah_A3update_picture1',
          'security': frontEndAjaxA3.nonce,
          'imageId1': imtah_attachmentA1.id
        };

        jQuery.post(ajaxurl, data, function() {

        });
    });

///////////////////////////--------Image2--------/////////////////////////////

var imtah_animation3_uploadButton2 = document.getElementById( 'imtah_animation3_upload_image_button2' );
var imtah_animation3_img2 = document.getElementById( 'imtah_animation3_image-preview2' );
var imtah_animation3_image_attachment_id2 = document.getElementById('imtah_animation3_image_attachment_id2')

var imtah_animation3_customUploader2 = wp.media({
    title: 'Select an Image',
    button: {
        text: 'Use this Image'
    },
    multiple: false
});

imtah_animation3_uploadButton2.addEventListener( 'click', function() {

    if ( imtah_animation3_customUploader2 ) {
        imtah_animation3_customUploader2.open();
    }
} );

imtah_animation3_customUploader2.on( 'select', function() {
    var imtah_attachmentA2 = imtah_animation3_customUploader2.state().get('selection').first().toJSON();
    imtah_animation3_img2.setAttribute( 'src', imtah_attachmentA2.url );
    imtah_animation3_image_attachment_id2.setAttribute('value',imtah_attachmentA2.id);
    var data = {
          'action': 'imtah_A3update_picture2',
          'security': frontEndAjaxA3.nonce,
          'imageId2': imtah_attachmentA2.id
        };

        jQuery.post(ajaxurl, data, function() {
        //alert('success');
        });
    });