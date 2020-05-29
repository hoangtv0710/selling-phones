$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    $('.qty').blur(function(){
        let rowId = $(this).data('id');
        $.ajax({
            url : 'cart_detail/'+rowId,
            type : 'put',
            dataType : 'json',
            data : {
                qty : $(this).val(),
            },
            success : function($result){
                if($result.error){
                    toastr.error($result.error, 'Thông báo', {timeOut: 5000});
                } else {
                    toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                    location.reload();
                }
            }
        });
    });
    $('.delete_cart').click(function(){
        $('#delete').modal('show');
        let rowId = $(this).data('id');
        $('.delCart').click(function(){
            $.ajax({
                url : 'cart_detail/'+rowId,
                type : 'delete',
                dataType : 'json',
                success : function($result){
                    toastr.error($result.success, 'Thông báo', {timeOut: 5000});
                    location.reload();
                }
            });
        });
    });
});