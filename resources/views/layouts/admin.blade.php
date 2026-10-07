<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BookNest Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="admin-layout">
        <aside class="sidebar">
            <!-- Sidebar -->
            <div class="sidebar-brand">
                <h2>📚 BookNest</h2>
                <p>Admin Panel</p>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
                <a href="{{ route('admin.books.index')}}">📚 Books</a>
                <a href="{{ route('admin.authors.index')}}">✍️ Authors</a>
                <a href="{{ route('admin.categories.index')}}">🏷️ Categories</a>
                <a href="{{ route('admin.publishers.index')}}">🏢 Publishers</a>
                <a href="{{ route('admin.orders.index') }}">📦 Orders</a>
                <a href="{{ route('admin.sliders.index')}}">🖼️ Sliders</a>
            </nav>

            <div class="sidebar-logout">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        🚪 Logout
                    </button>
                </form>

            </div>
        </aside>

        <div class="main-wrapper">
            <header class="topbar">
                <div class="topbar-title">
                    <h3>@yield('title', 'BookNest Admin')</h3>
                </div>

                <div class="admin-profile">
                    👤 Admin
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
