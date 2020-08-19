<script>
    // $('#price-admin').on('input', function(e){  \
    //     $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
    // }).on('keypress',function(e){
    //     if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    // }).on('paste', function(e){    
    //     alert("oke");
    //     var cb = e.originalEvent.clipboardData || window.clipboardData;      
    //     if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
    // });

    $('#selecctall').click(function(event) {
        if (this.checked) {
            $('.checkboxArt').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkboxArt').each(function() {
                this.checked = false;
            });
        }
    });

    $(".confirmManager").click(function(e) {
        var element = $(this);
        var action = element.attr("id");
        confirm("Tất cả các dữ liệu liên quan đến bài viết sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
            if (this.data == true) document.getElementById("deleteArt").submit();
        });
    });
    $(".confirmManager2").click(function() {
        var element = $(this);
        var action = element.attr("id");
        confirm("Tất cả các dữ liệu, hình ảnh liên quan sẽ được xóa và không thể phục hồi.\nMục con của mục này sẽ được đẩy lên một bậc.\nBạn có muốn thực hiện không?", function() {
            if (this.data == true) window.location.href = action;
        });
    });
    $(".alertManager").boxes('alert', 'Bạn không được phân quyền với chức năng này.');
</script>
<script>
    $('#wrapper').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });
    $('#dataTablesList').find('input[type="checkbox"]').shiftSelectable();
</script>



<!--     <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> -->
<!--   <script type="text/javascript" src="{{asset('ckfinder/ckfinder.js')}}"></script> -->

 <!-- CKEditor -->
<script type="text/javascript" src="{{asset('admin/editor/ckeditor/ckeditor.js')}}"></script>
<!-- CKFinder -->
<script type="text/javascript" src="{{asset('admin/editor/ckfinder/ckfinder.js')}}"></script>

<script> CKEDITOR.replace('content', {
        height: 250,
        filebrowserBrowseUrl: '{{ asset('admin/editor/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('admin/editor/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('admin/editor/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('upload/ckfinder') }}',
        filebrowserUploadUrl: '{{ asset('admin/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('admin/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('admin/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
 </script> 


<script type="text/javascript" src="{{URL::to('admin/js/cart.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/contact.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/article.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/page.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/gallery.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/other.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/product.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/core_role.js')}}"></script>
<script type="text/javascript" src="{{URL::to('admin/js/menu/core_user.js')}}"></script>