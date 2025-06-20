<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="{{ asset('/assets/image/logo.png') }}">
    <title>Reimbursement App</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <main>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="center shadow" id="">
                <img src="{{ asset('assets/image/logo.png') }}" alt="" id="" style="max-width:150px;">
                @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div id="form-login">
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <input type="password" name="password" placeholder="********" required>
                </div>
                <input type="submit" name="login" value="Login" id="btn-login">
            </div>
        </form>
    </main>
</body>

</html>