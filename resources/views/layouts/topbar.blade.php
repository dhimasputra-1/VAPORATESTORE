<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="d-flex justify-content-between w-100 px-3">
        {{-- User Info --}}
        <span class="text-gray-800 small font-weight-bold">
            {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
        </span>

        {{-- Logout --}}
        <a class="btn btn-sm btn-danger" href="/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</nav>
