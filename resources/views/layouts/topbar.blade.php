<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="d-flex justify-content-between w-100 px-3">
        <span class="text-gray-800 small font-weight-bold">
            {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
        </span>

        <!-- Logout langsung pakai form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</nav>
