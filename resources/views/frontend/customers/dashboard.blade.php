<h1>This is customer dashboard</h1>
<span>@auth
    {{auth()->user()->name}};
    @endauth</span>