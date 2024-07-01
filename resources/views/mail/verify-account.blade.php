<h3>Hi: {{$account->ho_ten}}</h3>
<p>
   Xin vui lòng nhấn vào link bên dưới để xác nhận tài khoản của bạn
</p>
<a href="{{route('user.verify', $account->email)}}">Click here to verify your account</a>