@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('things.update_process', $thing->id) }}" method="POST">
                @csrf

                @method('PATCH')
                <div class="form-group">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название вещи</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               value="{{ $thing->name }}"
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
                                  placeholder="Описание"
                        >{{ $thing->description }}</textarea>

                        @error('description')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="wrnt" class="form-label">Гарантия вещи</label>
                        <input type="text" name="wrnt"
                               class="form-control @error('wrnt') is-invalid @enderror"
                               value="{{ $thing->wrnt }}"
                        >

                        @error('wrnt')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Обновить</button>
            </form>
        </div>
    </div>
@endsection
