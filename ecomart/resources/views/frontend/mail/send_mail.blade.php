<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" style="font-family:Arial,serif;">[LIÊN HỆ]: {{$data['name']}}()</h4>
    </div>
    <div class="modal-body">
        <div marginwidth="0" marginheight="0" style="font-family:Arial,serif;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="table-layout:fixed;">
                <tbody>
                    <tr>
                        <td align="top" bgcolor="#f5f5f5" style="border-top:3px solid #579902;padding:0;">
                            <div style="min-height:35px">&nbsp;</div>
                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="width:90%;margin:0 auto;font-size:13px;color:#666666;font-weight:normal;text-align:left;font-family:Arial,serif;line-height:18px;" width="620">
                                <tbody>
                                    <tr>
                                        <td style="border-left:6px solid #fb651b;font-size:13px;color:#666666;font-weight:normal;text-align:left;font-family:Arial,serif;line-height:18px;vertical-align:top;padding:15px 8px 25px 20px;" bgcolor="#fdfdfd">
                                            <p style="margin: 10px 0">Chào <b>{{$data['name']}}</b>,</p>
                                            <p style="margin: 10px 0">Xin chân thành cảm ơn Quý khách đã quan tâm và sử dụng dịch vụ của chúng tôi! Yêu cầu của Quý khách đã gửi thành công. Chúng tôi sẽ phản hồi lại trong vòng 24h tới.</p>
                                            <p style="margin: 10px 0"><b style="text-decoration:underline;">THÔNG TIN CỦA QUÝ KHÁCH:</b><br><label style="font-weight:600;padding-left:12px;">Họ và tên: </label>{{$data['name']}}<br><label style="font-weight:600;padding-left:12px;">Email: </label>                                                {{$data['email']}}<br><label style="font-weight:600;padding-left:12px;">Số điện thoại: </label>{{$data['phone']}}<br><label style="font-weight:600;padding-left:12px;">Nội dung: </label>{{$data['content']}}<br>
                                                <label style="font-weight:600;padding-left:12px;">IP: </label> 116.110.121.30<br><label style="font-weight:600;padding-left:12px;">Ngày gửi liên hệ: </label> <br></p>
                                            <p style="margin: 10px 0">Đây là hộp thư tự động. Sau thời gian trên nếu quý khách chưa nhân được phản hồi từ nhân viên của chúng tôi, rất có thể đã gặp sự cố nhỏ nào đó vì vậy Quý khách có thể liên hệ trực tiếp chúng tôi để nhận được
                                                những thông tin nhanh nhất.</p>
                                            <p style="margin: 10px 0">Chân thành cảm ơn!</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="min-height:35px">&nbsp;</div>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                <tbody>
                                    <tr>
                                        <td bgcolor="#e1e1e1" style="padding:15px 10px 25px">
                                            <table border="0" cellpadding="0" cellspacing="0" align="left" style="margin:0 auto;" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <table ellpadding="0" cellspacing="0" border="0" align="left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" style="font-size:12px;color:#5e5e5e;font-family:Arial,serif;line-height:15px;">JETART</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table cellpadding="0" cellspacing="0" border="0" align="right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-size:13px;color:#5e5e5e;font-family:Arial,serif;line-height:1;vertical-align:top;text-align:right;font-style:italic;"><span>Follow us on</span><br>
                                                                            <a href="https://www.facebook.com" target="_blank"><img src="https://ci5.googleusercontent.com/proxy/PMSfAkbhhMLEe-tDCLFilReG-hlq_DWsTblTQ2qp8Dsq9KFW1UyFcKTr_uwU3EqyR8AhiFIooeExoAw9Oe3G5c6hvIEoOnU=s0-d-e1-ft#https://www.livecoding.tv/static/img/email/fb.png"
                                                                                    width="27" height="27" alt="Facebook logo" title="Facebook" border="0" style="padding:3px;"></a>&nbsp;
                                                                            <a href="https://twitter.com" target="_blank"><img src="https://ci3.googleusercontent.com/proxy/GNHxgrYKL99Apyic0XnGYk6IqVZAc-wFuhgCDxzBYMr80NGggmI1nRORIBVRIkPkJHbQHGGMrTFtbzTDoxk5dc0i_H0HOc0=s0-d-e1-ft#https://www.livecoding.tv/static/img/email/tw.png"
                                                                                    width="27" height="27" alt="Twitter logo" title="Twitter" border="0" style="padding:3px;"></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>