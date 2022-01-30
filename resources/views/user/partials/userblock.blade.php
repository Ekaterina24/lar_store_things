<div class="media">
    <div class="media-body">
        <h5 class="mt-0">
            <a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getUsername() }}</a>
        </h5>

        @if($user->location)
            <p>{{ $user->location }}</p>
        @endif
    </div>
</div>
