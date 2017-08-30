/**
 * Created by PA25072016 on 6/8/2017.
 */

jQuery(function($){
   $(document).ready(function(){
       var media_uploader;
       $('body').on('click', '.upload-button', function(event){
           event.preventDefault();
           var parent = $(this).closest('.upload-wrapper');
           media_uploader = wp.media.frames.file_frame = wp.media({
               title: $(this).data( 'uploader_title' ),
               button: {
                   text: $(this).data( 'uploader_button_text' )
               },
               multiple: false
           });
           media_uploader.open();
           select_media( parent );
       });

       $('body').on('click', '.delete-button', function(event){
           event.preventDefault();
           var title = $(this).data('delete-title');
           if(confirm(title)) {
               var parent = $(this).closest('.upload-wrapper');
               parent.find('.save-image-id').val('');
               parent.find('.upload-items').empty();
               $(this).addClass('none');
           }
       });

       function select_media( parent ){
           media_uploader.on("select", function(event){

               var json = media_uploader.state().get("selection").first().toJSON();
               var image_url = json.url;
               if( typeof image_url == 'string' && image_url != ''){
                   console.log(image_url);
                   var html = '<div class="upload-item"> '+
                       '<img src="'+ image_url+'" alt="" class="frontend-image img-responsive">'+
                       '</div>';
                   $('.upload-items',parent).html(html);
                   parent.find('.upload-button').removeClass('no_image');
               }else{
                   $('.upload-items', parent).empty();
               }
               $('.save-image-id', parent).val(json.id);
               $('.delete-button', parent).removeClass('none');
           });
       }

       $('.st-location-airport').select2();

   });
});