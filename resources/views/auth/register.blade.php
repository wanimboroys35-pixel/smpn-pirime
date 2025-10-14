<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SMP Negeri 1 Pirime</title>
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
            max-width: 450px;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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

    <h3 class="text-center mb-4 text-primary">Daftar Akun</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   id="name" 
                   required 
                   value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   id="email" 
                   required 
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" 
                   name="password_confirmation" 
                   class="form-control" 
                   id="password_confirmation" 
                   required>
        </div>

        <!-- Role default User (hidden) -->
        <input type="hidden" name="role" value="user">

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>

    <div class="mt-3 text-center">
        <a href="{{ route('login') }}">Sudah punya akun? <strong>Login</strong></a>
    </div>
</div>

</body>
</html>
