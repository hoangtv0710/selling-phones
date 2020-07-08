$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    $('.cate_id').change(function(){
        let cate_id = $(this).val();
        console.log(cate_id);
        $.ajax({
            url : 'getProductType',
            data : {
                cate_id : cate_id,
            },
            type : 'get',
            dataType : 'json',
            success : function($data){
                let html = '';
                $.each($data,function($key,$value){
                    html += '<option value='+$value['id']+'>';
                        html += $value['name'];
                    html += '</option>';
                });
                $('.productType_id').html(html);
            }
        });
    });
    //update
    $('.edit').click(function(){
		$('.errorName').hide();
		$('.errorQuantity').hide();
		$('.errorPrice').hide();
		$('.errorPromotional').hide();
		$('.errorImage').hide();
		$('.errorDescription').hide();
		let id = $(this).data('id');
		$('.idProduct').val(id);
		$.ajax({
			url : 'admin/product/'+id+'/edit',
			dataType : 'json',
			type : 'get',
			success : function(data){
				$('.name').val(data.product.name);
				$('.quantity').val(data.product.quantity);
				$('.price').val(data.product.price);
				$('.promotional').val(data.product.promotional);
				$('.imageThum').attr('src','images/products/'+data.product.image);
				if(data.product.status == 1){
                    $(".show").prop("checked", true)
                } else {
                    $(".hide").prop("checked", true)
                }
				CKEDITOR.instances['editor'].setData(data.product.description);
				let html = '';
				$.each(data.category,function(key,value){
					if(data.product.cate_id == value['id']){
						html += '<option value="'+value['id']+'" selected>';
							html += value['name'];
						html += '</option>';
					}else{
						html += '<option value="'+value['id']+'">';
							html += value['name'];
						html += '</option>';
					}
				});
				$('.cate_id').html(html);
				let html2 = '';
				$.each(data.product_type,function(key,value){
					if(data.product.productType_id == value['id']){
						html2 += '<option value="'+value['id']+'" selected>';
							html2 += value['name'];
						html2 += '</option>';		
					}else{
						html2 += '<option value="'+value['id']+'">';
							html2 += value['name'];
						html2 += '</option>';	
					}
				});
				$('.productType_id').html(html2);
			}
		});
		$('#updateProduct').on('submit',function(event){
			//chặn form submit
			event.preventDefault();
			$.ajax({
				url : 'admin/updateProduct/'+id,
				data : new FormData(this),
				contentType : false,
				processData : false,
				cache : false,
				type : 'post',
				success : function(data){
                    toastr.success(data.success, 'Thông báo', {timeOut: 5000});
                    $('#edit').modal('hide');
                    location.reload();
                },
                error: function(error){
                    let errors = JSON.parse(error.responseText);
                    
                    if(errors.errors.name){
                        $('.errorName').show();
                        $('.errorName').text(errors.errors.name);
                    }
                    if(errors.errors.quantity){
                        $('.errorQuantity').show();
                        $('.errorQuantity').text(errors.errors.quantity);
                    }
                    if(errors.errors.price){
                        $('.errorPrice').show();
                        $('.errorPrice').text(errors.errors.price);
                    }
                    if(errors.errors.promotional){
                        $('.errorPromotional').show();
                        $('.errorPromotional').text(errors.errors.promotional);
                    }
                    if(errors.errors.image){
                        $('.errorImage').show();
                        $('.errorImage').text(errors.errors.image);
                    }
                    if(errors.errors.description){
                        $('.errorDescription').show();
                        $('.errorDescription').text(errors.errors.description);
                    }
                }
			});
		});
	});
    //delete
    $('.delete').click(function(){
        let id = $(this).data('id');
        $('.delProduct').click(function(){
            $.ajax({
                url : 'admin/product/'+id,
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