$(document).ready(function(){

	$('.is_active_page').click(function(){
		let id = $(this).attr('value');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_page/page",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})

})