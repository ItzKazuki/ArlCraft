@if (session()->has('error'))
    <div class="card mb-3 border-left-danger">
        <div class="card-body">
            {{ session('error') }}
        </div>
    </div>
@endif