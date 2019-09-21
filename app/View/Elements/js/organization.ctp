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

    
    $('#OrganisationAdminAddOrganisationForm').validate({
        rules:{
            "DesignationCategory[category_id][]":{
                require_from_group:[1, '.cate']
            }
        }
    });
});
</script>