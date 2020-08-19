$(document).ready(function(){

	$('.add-product').click(function(e){
		e.preventDefault();

		let id_product = $(this).attr('id');

		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});
		$.ajax({

			type:"post",

			url :"/add_product/product",

			data : {

				id_product : id_product,

			},

			cache:false,

			success:function(data){
				
				$('#count-cart').html(data);

			}

		})
	})



	$('.change_quantity').blur(function(e){

		let quantity_number = $(this).val();

		let id_product = $(this).attr('id');

	})

	$('.change_quantity').change(function(e){

		let quantity_number = $(this).val();

		let id_product = $(this).attr('id');

		let price = $('#cart_price_'+id_product).val();

		let total = parseInt(price) * parseInt(quantity_number);

		if(quantity_number <= 0){

			$('.tr_'+id_product).remove();

			quantity_number = 0 ;

		}

		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});

		$.ajax({

			type:"post",

			url :"/quantity_product/product",

			data : {
				total : total ,

				quantity_number : quantity_number,

				id_product : id_product,

			},

			cache:false,

			success:function(arrCountTotal){

				$('#total_'+id_product).html(arrCountTotal['total'] + ' VNĐ');

				$('.cart-add').html(arrCountTotal['count']);

				$('#sumtotal').html(arrCountTotal['sumtotal'] + 'VNĐ');

			}

		})

	});

	// $('.change_quantity').change(function(e){

	// 	let quantity_number = $(this).val();

	// 	let id_product = $(this).attr('id');

	// 	let price = $('#cart_price_'+id_product).val();

	// 	let subtotal = parseInt(quantity_number) * parseInt(price);

	// 	let value_remove = $(this).attr('value');

	// 	let value_total = $('#total').html();

	// 	let total = $('#total').html();

	// 	$('#total').html(value_total - value_remove);

	// 	if(quantity_number <= 0){

	// 		$('#total').html(value_total - $('#cart_total_'+id_product).val());

	// 		$('.tr_'+id_product).remove();

	// 		quantity_number = 0 ;

	// 	}
		
		// $.ajaxSetup({

  //       	headers: {
  //          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       	}

  //      	});

		// $.ajax({

		// 	type:"post",

		// 	url :"/quantity_product/product",

		// 	data : {

		// 		quantity_number : quantity_number,

		// 		id_product : id_product,

		// 	},

		// 	cache:false,

		// 	success:function(arrCountTotal){

		// 		$('#cart_total_'+id_product).html(subtotal);

		// 		$('.cart-add').html(arrCountTotal['count']);

		// 		$('#total').html(arrCountTotal['total']);

		// 	}

		// })

	// })

	$('#province').change(function(){

		let idProvince = $(this).val();

		if(idProvince < 10) {
			idProvince = '0'+idProvince;
		}
		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});

		$.ajax({

			type:"post",

			url :"/province/action",

			data : {

				idProvince : idProvince,

			},

			cache:false,

			success:function(response){
				$('#district').html(response);
			}

		})

	})

	$('#district').change(function(){

		let idDistrict = $(this).val();
		if(idDistrict < 10 ){
			idDistrict = "00" + idDistrict;
		}else if(idDistrict < 100 &&idDistrict >= 10){
			idDistrict = "0" + idDistrict;
		}
		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});

		$.ajax({

			type:"post",

			url :"/district/action",

			data : {

				idDistrict : idDistrict,

			},

			cache:false,

			success:function(response){
				$('#ward').html(response);
			}

		})

	})

	$('#province_difference').change(function(){

		let idProvince = $(this).val();

		if(idProvince < 10) {
			idProvince = '0'+idProvince;
		}

		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});

		$.ajax({

			type:"post",

			url :"/province/action",

			data : {

				idProvince : idProvince,

			},

			cache:false,

			success:function(response){
				$('#district_difference').html(response);
			}

		})

	})

	$('#district_difference').change(function(){

		let idDistrict = $(this).val();

		if(idDistrict < 10 ){
			idDistrict = "00" + idDistrict;
		}else if(idDistrict < 100 &&idDistrict >= 10){
			idDistrict = "0" + idDistrict;
		}
		
		$.ajaxSetup({

        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}

       	});

		$.ajax({

			type:"post",

			url :"/district/action",

			data : {

				idDistrict : idDistrict,

			},

			cache:false,

			success:function(response){
				$('#ward_difference').html(response);
			}

		})

	})

	
})