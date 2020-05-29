$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    $('.edit').click(function(){
        $('.error').hide();
        let id = $(this).data('id');
        //edit
        $.ajax({
            url : 'admin/product_type/'+id+'/edit',
            dataType : 'json',
            type : 'get',
            success : function($result){
                console.log($result);
                $('.title').text($result.product_type.name);
                $('.name').val($result.product_type.name);
                var html = '';
                $.each($result.category,function($key,$value){
					if($value['id'] == $result.product_type.cate_id){
						html += '<option value='+$value['id']+' selected>';
							html += $value['name'];
						html += '</option>';	
					}else{
						html += '<option value='+$value['id']+'>';
							html += $value['name'];
						html += '</option>';
					}	
				});
                $('.cate_id').html(html);
                if ($result.product_type.status == 1) {
                    $(".show").prop("checked", true)
                } else {
                    $(".hide").prop("checked", true)
                }
            }
        });
        $('.update').click(function(){
            let name = $('.name').val();
            let cate_id = $('.cate_id').val();
            let status = ($("#status").prop("checked") == true ? '1' : '0');
            $.ajax({
                url : 'admin/product_type/'+id,
                data: {
                    name : name,
                    cate_id : cate_id,
                    status : status,
                    id : id
                },
                type: 'put',
                dataType : 'json',
                success : function($result){
                    toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                    $('#edit').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    var errors = JSON.parse(error.responseText);
                    $('.error').show();
                    $('.error').text(errors.errors.name);
                }
            });
        });
    });
    //delete
    $('.delete').click(function(){
        let id = $(this).data('id');
        $('.del').click(function(){
            $.ajax({
                url : 'admin/product_type/'+id,
                dataType : 'json',
                type : 'delete',
                success : function($result){
                    toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                    $('#delete').modal('hide');
                    location.reload();
                }
            });
        });
    });
});