<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')

    @if(Session::has("isLogged") && Session::get("isLogged"))
        Hello {{Session::get("email")}}

        <a href="{{route("logout")}}">Logout</a>
    @else
        you are not logged in
    @endif
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
