$(document).ready(function(){
	$('.is_active_category_gallery').click(function(){

		let id = $(this).attr('value');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_category_gallery/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})
	$('.hot_category_gallery').click(function(){

		let id = $(this).attr('value');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_category_gallery/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})
	$('.show_gallery_menu').click(function(){

		let id = $(this).attr('value');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/show_gallery/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})
	$('.hot_gallery_menu').click(function(){

		let id = $(this).attr('value');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_gallery_menu/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})
	$('.is_active_gallery').click(function(){

		let id = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_gallery/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})

	$('.hot_gallery').click(function(){

		let id = $(this).attr('id');

		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_gallery/gallery",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})

	})

	$('.sort_category').change(function(){

		let sort = $(this).val();

		let category_id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/sort_category/gallery",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				sort : sort,
				category_id : category_id,
			},
			cache:false,
			success:function(response){
				location.reload();
			}
		})

	})

	$('.sort_gallery').change(function(){

		let sort = $(this).val();
		let gal_id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/sort_gallery/sort",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				sort : sort,
				gal_id : gal_id,
			},
			cache:false,
			success:function(response){
				location.reload();
			}
		})

	})
})