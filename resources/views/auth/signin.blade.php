@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Войти на сайт</h3>
            <form method="POST" action="{{ route('auth.signin_process') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" placeholder="например, user@gmail.com"
                           value="{{ Request::old('email') ?: '' }}"
                    >

                    @error('email')
                    <p class="help-block text-danger">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password" placeholder="минимум 6 символов"
                    >

                    @error('password')
                    <p class="help-block text-danger">{{ $message }}</p>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
@endsection

