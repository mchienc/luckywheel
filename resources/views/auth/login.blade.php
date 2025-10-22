@extends('layouts.app')

@section('content')
<div class="login-box mx-auto">
    <div class="login-logo">
        <a href="/"><b>Lucky</b>Wheel</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập để bắt đầu quay thưởng</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Mật khẩu" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                </div>
                
                <div class="social-auth-links text-center mb-3">
                    <p>- hoặc -</p>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-block btn-success">
                            <i class="fas fa-user-plus mr-2"></i> Đăng ký tài khoản mới
                        </a>
                    @endif
                </div>

                @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                    </p>
                @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
