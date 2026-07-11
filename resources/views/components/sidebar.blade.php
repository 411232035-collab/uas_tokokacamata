<aside class="sidebar">
    <div class="brand d-flex align-items-center gap-2">
        <i class="fas fa-store text-danger"></i>
        <span>Smart Catalog</span>
    </div>
    <nav class="mt-3">
        <a href="{{ route('dashboard') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
        <a href="{{ route('products.index') }}"><i class="fas fa-box me-2"></i> Products</a>
        <a href="{{ route('categories.index') }}"><i class="fas fa-tags me-2"></i> Categories</a>
        <a href="{{ route('transactions.index') }}"><i class="fas fa-receipt me-2"></i> Transactions</a>
        <a href="{{ route('stocks.index') }}"><i class="fas fa-cubes me-2"></i> Stocks</a>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('reports.index') }}"><i class="fas fa-file-export me-2"></i> Reports</a>
                <a href="{{ route('admin.banner') }}"><i class="fas fa-image me-2"></i> Upload Banner</a>
                <a href="{{ route('admin.panel') }}"><i class="fas fa-user-shield me-2"></i> Admin Panel</a>
            @else
                <a href="{{ route('staff.workspace') }}"><i class="fas fa-user me-2"></i> Staff Workspace</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 text-start">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        @endauth
    </nav>
</aside>
