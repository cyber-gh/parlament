<form method="post">

    @if(Session::has("error"))
        <p>{{Session::get("error")}}</p>
    @endif

    @csrf
    Username <input type="email" required name="email">
    Password <input type="password" required name="password">


    <div class="form-group">
        <button type="submit" class="btn btn-primary submit-btn">Log in</button>
    </div>

    <div class="form-group">
        @foreach($errors->all() as $message)
            <p>{{$message}}</p>
        @endforeach
    </div>
</form>
