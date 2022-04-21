@if(session()->has('flash'))
    <div class="alert alert-success mt-5">
        {{ session('flash') }}
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-danger mt-5">
        {{ session('danger') }}
    </div>
@endif
