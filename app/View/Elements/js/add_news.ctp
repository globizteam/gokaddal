<script>
	$(document).ready(function(){
    $('.parent-category').change(function(){
        var parentId = $(this).val();
        if( $(this).is(':checked') ) {
            $('.child-category-'+parentId).prop('checked',true);
        } else {
            $('.child-category-'+parentId).prop('checked',false);
        }
    });

    $('.child-category').change(function(){
        var parentId = $(this).attr('parentId');
        if($(this).is(':checked') && !$('#parent_cate_'+parentId).is(':checked') ) {
            $('#parent_cate_'+parentId).prop('checked',true);
        }
    });

    var newsType = $('#NewType').val();
    var extensions = "jpg|jpeg|png";
    switch(newsType) {
        case 'image':
            extensions = "jpg|jpeg|png";
            break;
        case 'audio':
            extensions = "mp3";
            break;
        case 'video':
            extensions = "mp4|avi|mov";
            break;
        case 'pdf':
            extensions = "pdf";
            break;
        default:
            extensions = "jpg|jpeg|png";
            break;
    }
    
    $('#NewType').on('change', function(){
         $('#NewFile').rules('remove');
         $('.thumbnail').hide();
        if( $(this).val() == 'audio' ) {
            extensions = 'mp3';
            $('#NewFile').rules('add', {
                "extension":extensions
            });
        }else if($(this).val() == 'video' ) {
            extensions = 'mp4|avi';
            $('.thumbnail').show();
            $('#NewFile').rules('add', {
                "extension":extensions
            });
        }   else if( $(this).val() == 'pdf' ){ 
            extensions = "pdf";
            $('#NewFile').rules('add', {
                "extension":extensions
            });
        }else {
            extensions = "jpg|jpeg|png";
            $('#NewFile').rules('add', {
                "extension":extensions
            });
        }

    });
    
    $('#NewAdminAddNewsForm').validate({
        rules:{
            "file":{
                "extension": extensions
            }
        }
    });
});
</script>