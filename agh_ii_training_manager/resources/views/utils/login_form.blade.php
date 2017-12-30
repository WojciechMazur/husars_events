    <form class="login-form" method="POST" action="{{route('login')}}">
        {{csrf_field()}}
        <input type="email" name="email" id="email" placeholder="Email address">
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">
            Login <i class="fa fa-sign-in" aria-hidden="true"></i>
        </button>
    </form>
