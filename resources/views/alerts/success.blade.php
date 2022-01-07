@if (session($key ?? 'status'))
    <div class="alert alert-success" role="alert">
        {{ session($key ?? 'status') }}
    </div>
@endif


@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('error') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif
