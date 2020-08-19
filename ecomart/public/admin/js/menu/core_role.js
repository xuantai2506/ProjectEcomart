$(document).ready(function(){
	$('.is_active_core_roles').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_core_role/core",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
})