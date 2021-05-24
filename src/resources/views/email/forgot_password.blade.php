<h1>TasteBuds - Recover Password</h1>

<p>You can reset your password from bellow link:</p>

<a class="mt-5" href="{{ url('reset_password/' . (isset($token) ? $token : '')) }}">Reset Password</a>
