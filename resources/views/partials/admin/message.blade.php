<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        @if (Auth::user()->unreadNotifications->count() != 0)
            <span
                class="badge badge-danger badge-counter">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Notifications
        </h6>
        @foreach (Auth::user()->unreadNotifications->sortBy('created_at')->take(5) as $notification)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.notification.show', $notification->id) }}">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($notification->data['email']))) }}" alt="...">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">{{ $notification->data['title'] }}</div>
                    <div class="small text-gray-500">{{ $notification->data['name'] }} · {{ $notification->created_at->longAbsoluteDiffForHumans() }}</div>
                </div>
            </a>
        @endforeach
        <a class="dropdown-item text-center small text-gray-500" href="{{ route('dashboard.notification') }}">See all Notifications</a>
    </div>
</li>