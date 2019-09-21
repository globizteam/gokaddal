<script type="text/javascript">
    $(document).ready(function(){
        $('#organ_id').on('change',function(){
            var organId = $(this).val();
            $.ajax({
                type : "post",
                url : "<?php echo $this->webroot?>admin/Users/getDeparment/"+organId,
                success : function(resp){
                    var re = $.parseJSON(resp);
                    if(re.status){
                        $('#depart_id').html(re.data);
                        $('#desig_id').html(re.designation);
                    }else{
                        $('#depart_id').html(re.data);
                    }
                } 
            });
        });

        /*$('#depart_id').on('change',function(){
            var organId = $(this).val();
            $.ajax({
                type : "post",
                url : "<?php echo $this->webroot?>admin/Users/getDesignation/"+organId,
                success : function(resp){
                    var re = $.parseJSON(resp);
                    if(re.status){
                        $('#desig_id').html(re.data);
                    }else{
                        $('#desig_id').html(re.data);
                        alert(re.msg);
                    }
                } 
            });
        });*/
    });
</script>