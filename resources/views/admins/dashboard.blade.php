<h1>This is admin dashboard</h1>
<span>@auth
    {{auth()->user()->name}};
    @endauth</span>