@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('things_process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название вещи</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               value="{{ Request::old('name') ?: '' }}"
                        >

                        @error('name')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание вещи</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description"
                                  rows="3"
                        ></textarea>

                        @error('description')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="wrnt" class="form-label">Гарантия вещи</label>
                        <input type="text" name="wrnt"
                               class="form-control @error('wrnt') is-invalid @enderror"
                               value="{{ Request::old('wrnt') ?: '' }}"
                        >

                        @error('wrnt')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Опубликовать</button>
            </form>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-6">
                <hr>

                @if(!$things->count())
                    <p>Пока нет ни одной созданной вещи.</p>
                @else
                    @foreach($things as $thing)
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Вещь: {{ $thing->name }}</h5>
                                    <small class="text-muted">{{ $thing->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Описание: {{ $thing->description }}</p>
                                <p class="mb-1">Срок годности: {{ $thing->wrnt }}</p>
                                <small class="text-muted">
                                        Пользователь: {{ $thing->user->getUsername() }}
                                </small>
                                <div class="d-flex">
                                    <form action="{{ route('things.update', $thing->id) }}" method="GET">
                                        @csrf

                                        <button type="submit" class="btn btn-success mt-3">Редактировать</button>
                                    </form>

                                    <form class="ms-3" action="{{ route('things.destroy', $thing->id) }}" method="POST">
                                        @csrf

                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    @endforeach
                <div class="m-3">
                    {{ $things->links() }}
                </div>
                @endif
            </div>
        </div>
@endsection
