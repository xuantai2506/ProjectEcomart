  <!-- Modal -->
                                @foreach($get_cart as $get_carts)
                                <div class="modal fade" id="_order_{{$get_carts['order_id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">[BOOKING ONLINE]: Tester (04/06/2020 09:37)</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div style="line-height: 20px;"><b>----- THÔNG TIN KHÁCH HÀNG ------</b><br>Họ và tên: <b>{{$get_carts['name']}}</b><br>Email: <b>{{$get_carts['email']}}</b><br>Số điện thoại: <b>{{$get_carts['phone']}}</b><br>Địa chỉ: <b>{{$get_carts['address_detail']}}</b><br>

                                                    <?php $address = json_decode($get_carts['address']) ?>
                                                    @foreach($get_province as $get_provinces)
                                                        @if($get_provinces['provinceId'] == $address[0])
                                                        Tỉnh / thành: <b>{{$get_provinces['name']}}</b> 
                                                        @endif
                                                    @endforeach
                                                    
                                                    @foreach($get_district as $get_districts)
                                                        @if($get_districts['districtId'] == $address[1])
                                                        - Quận / huyện: <b>{{$get_districts['name']}}</b> 
                                                        @endif
                                                    @endforeach

                                                    @foreach($get_ward as $get_wards)
                                                        @if($get_wards['wardid'] == $address[2])
                                                        - Phường / xã: <b>{{$get_wards['name']}}</b><br>
                                                        @endif
                                                    @endforeach

                                                    Yêu cầu: <b></b><br>
                                                    <b>{{$get_carts['name']}}</b> đặt hàng từ website http://storecongnghe.com.vn</div><br>
                                                <div style="line-height: 20px;">Vận chuyển: <b>Giao hàng tận nơi</b><br>Thanh toán: <b>Thanh toán trực tiếp</b></div><br>

                                                <div>
                                                    <p><b>----- ĐƠN ĐẶT HÀNG ------</b></p>
                                                    <table cellpadding="5" cellspacing="0" class="form-order" style="box-sizing: border-box; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-color: rgb(221, 221, 221); max-width: 100%;"
                                                        width="100%">
                                                        <thead style="box-sizing: border-box; border: 0px;">
                                                            <tr align="center" style="box-sizing: border-box; border: 0px;">
                                                                <td style="box-sizing: border-box; padding: 10px 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;"
                                                                    width="12%">Hình ảnh</td>
                                                                <td style="box-sizing: border-box; padding: 10px 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Sản phẩm</td>
                                                                <td style="box-sizing: border-box; padding: 10px 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Đơn giá</td>
                                                                <td style="box-sizing: border-box; padding: 10px 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;"
                                                                    width="12%">Số lượng</td>
                                                                <td style="box-sizing: border-box; padding: 10px 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Thành tiền</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $id_product = json_decode($get_carts['id_product']) ?>
                                                            <?php $quantity = json_decode($get_carts['quantity']) ?>
                                                            <?php $price = json_decode($get_carts['price']) ?>
                                                            <?php $total = 0 ?>
                                                            @foreach($get_product as $get_products)
                                                                @foreach($id_product as $key => $id_products)
                                                                    @if($get_products['product_id'] == $id_products)
                                                                    <tr style="box-sizing: border-box; border: 0px;">
                                                                        <td align="center" class="img" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); line-height: 0;">
                                                                            <a href="https://storecongnghe.com.vn/cong-tac-cam-ung-4-nut-kinh-phang-vien-nhom" title="Công Tắc Cảm Ứng 4 Nút, Kính Phẳng, Viền Nhôm."><img width="100px" src="{{asset('upload/product/'.$get_products['images'])}}" alt="Công Tắc Cảm Ứng 4 Nút, Kính Phẳng, Viền Nhôm."></a>
                                                                        </td>
                                                                        <td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><a href="https://storecongnghe.com.vn/cong-tac-cam-ung-4-nut-kinh-phang-vien-nhom" title="Công Tắc Cảm Ứng 4 Nút, Kính Phẳng, Viền Nhôm.">Công Tắc Cảm Ứng 4 Nút, Kính Phẳng, Viền Nhôm.</a></td>
                                                                        <td align="right" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><?php echo number_format($price[$key] - ($price[$key] * $get_products['sale'])/100); ?> ₫</td>
                                                                        <td align="center" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">{{$quantity[$key]}}</td>
                                                                        <td align="right" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><?php echo number_format(($price[$key] - ($price[$key] * $get_products['sale'])/100)* $quantity[$key])  ?> ₫</td>
                                                                     </tr>
                                                                    <?php $total += ($price[$key] - ($price[$key] * $get_products['sale'])/100) * $quantity[$key]?>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            <tr style="box-sizing: border-box; border: 0px;">
                                                                <td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">Tạm tính:</td>
                                                                <td align="right" class="total" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><?php echo number_format($total) ?> ₫</td>
                                                            </tr>
                                                            <tr style="box-sizing: border-box; border: 0px;">
                                                                <td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-left: 1px solid rgb(221, 221, 221);">Phí vận chuyển:</td>
                                                                <td align="right" class="total" style="box-sizing: border-box; padding: 5px; border-left: 1px solid rgb(221, 221, 221);">Liên hệ</td>
                                                            </tr>
                                                            <tr style="box-sizing: border-box; border: 0px;">
                                                                <td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><strong style="box-sizing: border-box; border: 0px; text-transform: uppercase;"><strong>Tổng cộng:</strong></strong>
                                                                </td>
                                                                <td align="right" class="total" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); font-size: 1.4em; font-weight: bold; color: rgb(155, 99, 46); text-decoration: underline;"><?php echo number_format($total) ?> ₫</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-form-primary btn-form" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /.modal -->