$(document).ready(function(){
	$('.remove-product').click(function(e){

		e.preventDefault();

		let id_product = $(this).attr('id');

		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});
       	
		$.ajax({

			type:"post",

			url :"/remove_product/product",

			data : {

				id_product : id_product,

			},

			cache:false,

			success:function(view){

				$('.tr_'+id_product).remove();

				$('#count-cart').html(view);

				$('#sumtotal').html($('#get_sumtotal').val());

			}

		})
	})
})