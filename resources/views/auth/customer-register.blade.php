<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <h2>Customer Register</h2>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('customer.register') }}" method="POST">
        @csrf
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="country" placeholder="Country" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="{{ route('customer.login') }}">Login</a></p>
</body>
</html>
