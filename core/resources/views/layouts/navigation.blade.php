<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">@lang('Dashboard')
                        <span class="visually-hidden">(@lang('current'))</span>
                    </a>
                </li>
            </ul>
            <a href="{{ route('profile.edit') }}" class="btn btn-secondary my-2 my-sm-0 me-2">
                @lang('Profile')
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-secondary my-2 my-sm-0">
                    @lang('Log Out')
                </a>
            </form>
        </div>
    </div>
</nav>