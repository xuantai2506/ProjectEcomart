$(document).ready(function(){
	$('.is_active_product_menu').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_product_menu/is_active",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot_product_menu').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_product_menu/hot",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.is_active_product').click(function(){
		let id = $(this).attr('id');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_product/is_active",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot_product').click(function(){
		let id = $(this).attr('id');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_product/hot",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	
	$('.sort_product').change(function(){

		let sort = $(this).val();
		let product_menu_id = $(this).attr('id');
		$.ajax({
			type:"post",
			url :"/admin/sort_product/product",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				sort : sort,
				product_menu_id : product_menu_id,
			},
			cache:false,
			success:function(response){
				location.reload();
			}
		})

	})
})