@extends('templates.default')

@section('content')
    <h3 class="mb-3">Другие вещи</h3>
        @foreach($things as $thing)
            <div class="list-group row col-lg-6">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Вещь: {{ $thing->name }}</h5>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($thing->created_at)->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">Описание: {{ $thing->description }}</p>
                    <p class="mb-1">Срок годности: {{ $thing->wrnt }}</p>
                    <small class="text-muted">
                        Пользователь: {{ $thing->user_id }}
                    </small>
                    <form action="{{ route('things.take', $thing->id) }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-success mt-3">Взять</button>
                    </form>
                </a>
            </div>
        @endforeach
    <div class="m-3">
        {{ $things->links() }}
    </div>
@endsection
