@extends('templates.default')

@section('content')
<p>У вас есть право на просмотр этого раздела.</p>
@can('view-protected-part')
<p>Вы katrik и у вас есть право на просмотр этого раздела.</p>
@endcan
@cannot('view-protected-part')
<p>Стоп! У вас нет прав на просмотр этого раздела.</p>
@endcan
@endsection
