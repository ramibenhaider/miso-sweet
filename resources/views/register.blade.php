<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <h4>Errors:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div><br>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
        </div><br>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" value="{{ old('password') }}" name="password">
        </div><br>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation">
        </div><br>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
