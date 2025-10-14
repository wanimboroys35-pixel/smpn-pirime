<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SMP Negeri 1 Pirime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #7a9fd6, #a7823c);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: transparent;
            border: 2px solid blue;
            backdrop-filter: blur(20px);
        }
        .btn-primary {
            width: 100%;
            font-weight: bold;
            border-radius: 0.5rem;
        }
        .logo {
            display: block;
            margin: 0 auto 1rem;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="card bg-white">
    <!-- Logo -->
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMP Negeri 1 Pirime" class="logo">
    
    <h3 class="text-center mb-4 text-primary">Login</h3>

    <!-- Error Message -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   id="email" 
                   required 
                   autofocus 
                   value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" 
                   name="password" 
                   class="form-control" 
                   id="password" 
                   required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <!-- Register Link -->
    <div class="mt-3 text-center">
        <a href="{{ route('register') }}">Belum punya akun? <strong>Daftar</strong></a>
    </div>
</div>

</body>
</html>
