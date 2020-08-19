$(document).ready(function(){
	$('.wishlist').click(function(e){
		e.preventDefault();

		let product_id = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/wishlist/action",
			data : {
				product_id : product_id,
			},
			cache:false,
			success:function(alerts){
			
			}
		})
 	})
 	$('.wishlist-remove').click(function(e){

 		e.preventDefault();

 		let product_id = $(this).attr('id');

 		$('.delete_'+product_id).remove();

 		$.ajaxSetup({

        	headers: {

           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        	}

       	});

		$.ajax({

			type:"post",

			url :"/wishlist-remove/action",

			data : {

				product_id : product_id,

			},

			cache:false,

			success:function(alerts){
			
			}
		})
 	})
})