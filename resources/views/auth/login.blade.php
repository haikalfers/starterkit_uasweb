@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-7 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h1 class="h4 text-gray-900">Selamat Datang!</h1>
                    <p>Masuk untuk mulai menggunakan aplikasi</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('password.request') }}">Lupa Password?</a>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </form>

                <hr>
                <div class="text-center">
                    <span>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></span>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
