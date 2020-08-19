$(document).ready(function(){
	$('.is_view_cart').click(function(){

		let id_cart = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});

		$.ajax({
			type:"post",

			url :"/admin/is_view_cart/action",

			data : {

				id_cart : id_cart,

			},

			cache:false,

			success:function(html){
				// $('#view_'+id_cart).html(html);
			}
		})

	})
	$('.is_show_cart').click(function(){
		let id_cart = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});

		$.ajax({
			type:"post",

			url :"/admin/is_show_cart/action",

			data : {

				id_cart : id_cart,

			},

			cache:false,

			success:function(html){
			}
		})
	})
})