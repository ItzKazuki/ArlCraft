@if (session()->has('success'))
    <div class="card mb-3 border-left-success">
        <div class="card-body">
            {{ session('success') }}
        </div>
    </div>
@endif