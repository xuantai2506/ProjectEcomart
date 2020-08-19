$(document).ready(function(){
	$('.is_active_core_user').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_core_user/core",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})

	$('.is_show_core_user').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_show_core_user/core",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
})