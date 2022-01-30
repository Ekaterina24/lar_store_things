@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @include('user.partials.userblock')
        </div>

        <div class="col-lg-4 col-lg-offset-3">

            @if(Auth::user()->hasFriendRequestPending($user))
                <p>В ожидании {{ $user->getUsername() }} подтверждения запроса в друзья.</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-primary mb-2">Подтвердить дружбу</a>
            @elseif(Auth::user()->isFriendWith($user))
                {{ $user->getUsername() }} у вас в друзьях.

                <form action="{{ route('friends.delete', ['username' => $user->username]) }}" method="POST">
                    @csrf

                    <input type="submit" class="btn btn-primary my-2" value="Удалить из друзей">
                </form>
            @elseif(Auth::user()->id !== $user->id)
                <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary mb-2">Добавить в друзья</a>
            @endif

            <h4>{{ $user->getUsername() }} друзья:</h4>

            @if(!$user->friends()->count())
                <p>{{ $user->getUsername() }} нет друзей.</p>
            @else
                @foreach($user->friends() as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@endsection

