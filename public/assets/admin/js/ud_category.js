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
            url : 'admin/category/'+id+'/edit',
            dataType : 'json',
            type : 'get',
            success : function($result){
                console.log($result);
                $('.title').text($result.name);
                $('.name').val($result.name);
                if ($result.status == 1) {
                    $(".show").prop("checked", true)
                } else {
                    $(".hide").prop("checked", true)
                }
            }
        });
        $('.update').click(function(){
            let name = $('.name').val();
            let status = ($("#status").prop("checked") == true ? '1' : '0');
            $.ajax({
                url : 'admin/category/'+id,
                data: {
                    name : name,
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
                url : 'admin/category/'+id,
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