$(document).ready(function(){
	$('.is_active_contact').click(function(){
		let id_contact = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});

		$.ajax({

			type:"post",

			url :"/admin/is_active_contact/action",

			data : {

				id_contact : id_contact,

			},
			cache:false,

			success:function(quantity){
				
			}
		})

	})
})