$(document).ready(function(){
	//article_manager
	//->show_Category và hot category là dành cho bảng category 
	$('.show_category').click(function(e){
		let id = $(this).attr('value');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/show_category/article",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot_category').click(function(e){
		let id = $(this).attr('value');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/hot_category/article",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	// show và hot dành cho bản article_menu
	$('.show').click(function(e){
		let id = $(this).attr('value');
		$.ajaxSetup({
        	headers: {
           		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
       	});
		$.ajax({
			type:"post",
			url :"/admin/show/article",
			data : {
				id : id,
			},
			cache:false,
			success:function(quantity){
				
			}
		})
	})
	$('.hot').click(function(){
		let id = $(this).attr('value');
		$.ajax({
			type:"post",
			url :"/admin/hot/article",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				id : id,
			},
			cache:false,
			success:function(response){
				console.log(response);
			}
		})
	})
	// is_active_article vaf hot_article danh cho bang article
	$('.is_active_article').click(function(){

		let id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/is_active/article",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				id : id,
			},
			cache:false,
			success:function(response){
				console.log(response);
			}
		})

	})

	$('.hot_article').click(function(){

		let id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/hot_article/article",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				id : id,
			},
			cache:false,
			success:function(response){
				console.log(response);
			}
		})

	})

	$('.sort_category').change(function(){

		let sort = $(this).val();
		let category_id = $(this).attr('id');

		$.ajax({
			type:"post",
			url :"/admin/sort_category/sort",
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

	$('.sort_article').change(function(){

		let sort = $(this).val();
		let art_id = $(this).attr('id');
		$.ajax({
			type:"post",
			url :"/admin/sort_article/sort",
			headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			data : {
				sort : sort,
				art_id : art_id,
			},
			cache:false,
			success:function(response){
				location.reload();
			}
		})

	})



	
})