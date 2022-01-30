@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Редактирование профиля</h3>
            <form method="POST" action="{{ route('profile.edit_process') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Ваше логин</label>
                    <input type="text" name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           id="username"
                           value="{{ Request::old('username') ?: Auth::user()->username }}"
                    >

                    @error('username')
                    <p class="help-block text-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Ваш новый пароль</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                    >

                    @error('password')
                    <p class="help-block text-danger">{{ $message }}</p>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">Обновить профиль</button>
            </form>
        </div>
    </div>
@endsection
