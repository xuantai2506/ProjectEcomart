$(document).ready(function(){
	$('.is_active_others_menu').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_others_menu/others",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot_others_menu').click(function(){
		let id = $(this).val();
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_others_menu/others",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.is_active_others').click(function(){
		let id = $(this).attr('id');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/is_active_others/others",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot_others').click(function(){
		let id = $(this).attr('id');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_others/others",
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
			url :"/admin/sort_category/others",
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

	$('.sort_others').change(function(){

		let sort = $(this).val();

		let others_menu_id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/sort_others/others",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				sort : sort,
				others_menu_id : others_menu_id,
			},
			cache:false,
			success:function(response){
				location.reload();
			}
		})

	})
})