@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
