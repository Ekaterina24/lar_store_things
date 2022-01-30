<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid container">
        <a class="navbar-brand" href="{{ route('home') }}">Storage of things </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::check())
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('things') }}">Мои вещи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('things.another') }}">Другие вещи</a>
                    </li>
{{--                    <form method="GET" action="#" class="d-flex ms-2">--}}
{{--                        <input name="query" class="form-control me-2" type="search" placeholder="Что ищем?" aria-label="Search">--}}
{{--                        <button class="btn btn-success" type="submit">Найти</button>--}}
{{--                    </form>--}}
                </ul>
            @endif
            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link">{{ Auth::user()->getUsername() }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Обновить профиль</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auth.signout') }}" class="nav-link">Выйти</a>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('auth.signup') }}" class="nav-link">Зарегистрироваться</a></li>
                    <li class="nav-item"><a href="{{ route('auth.signin') }}" class="nav-link">Войти</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
