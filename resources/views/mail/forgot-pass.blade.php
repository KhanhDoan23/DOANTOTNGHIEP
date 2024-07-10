<div style="border: 1px solid red;padding: 15px; background:lightgrey;width: 600px;margin: auto;">
    <h3>Hi {{$cus->ho_ten}}</h3>
    <p>
    Xin vui lòng nhấn vào link bên dưới để lấy lại mật khẩu của bạn
    </p>
    <p>
        <a href="{{route('user.reset-pass', $token)}}" style="display:inline-block;padding: 7px 25px;color:#fff;background:aqua">Click here to get new password</a>
    </p>
</div>