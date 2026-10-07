<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'BookNest')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>


<body class="public-body">

    {{-- NAVBAR --}}
    <header class="public-header">
        <nav class="public-navbar">

            {{-- BRAND --}}
            <a
                href="{{ route('home') }}"
                class="public-brand"
            >
                <span class="brand-icon">📚</span>

                <span>BookNest</span>
            </a>

            {{-- MENU --}}
            <div class="public-menu">
                 <a
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'active' : '' }}"
                >
                    Home
                </a>

                <a
                    href="{{ route('books.index') }}"
                    class="{{ request()->routeIs('books.*') ? 'active' : '' }}"
                >
                    Books
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"
                >
                    Categories
                </a>

                {{-- JIKA BELUM LOGIN --}}
                @guest

                    <a
                        href="{{ route('login') }}"
                        class="public-login-btn"
                    >
                        Login
                    </a>

                @endguest


                {{-- JIKA SUDAH LOGIN --}}
                @auth

                    {{-- CART --}}
                    <a
                        href="{{ route('cart.index') }}"
                    >
                        🛒 Cart
                    </a>


                    {{-- JIKA ADMIN --}}
                    @if (auth()->user()->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="public-login-btn"
                        >
                            👤 Admin
                        </a>

                    @else

                        {{-- CUSTOMER --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="public-login-btn"
                        >
                            👤 Dashboard
                        </a>

                    @endif
                @endauth
            </div>
        </nav>
    </header>


    {{-- MAIN CONTENT --}}
    <main class="public-main">

        @yield('content')

    </main>


    {{-- FOOTER --}}
    <footer class="public-footer">
        <div class="public-footer-container">

            {{-- BRAND --}}
            <div class="footer-brand">

                <h2>
                    📚 BookNest
                </h2>

                <p>
                    Temukan buku dan cerita yang
                    menemani perjalananmu.
                </p>

            </div>


            {{-- EXPLORE --}}
            <div class="footer-column">

                <h3>Explore</h3>

                <a href="{{ route('home') }}">
                    Home
                </a>

                <a href="{{ route('books.index') }}">
                    Books
                </a>

                <a href="{{ route('categories.index') }}">
                    Categories
                </a>

            </div>

            {{-- ACCOUNT --}}
            <div class="footer-column">

                <h3>Account</h3>

                @guest

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                @endguest

                @auth

                    <a href="{{ route('cart.index') }}">
                        Cart
                    </a>

                    @if (auth()->user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}">
                            Admin Dashboard
                        </a>

                    @else

                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>

                    @endif
                @endauth
            </div>
        </div>


        {{-- FOOTER BOTTOM --}}
        <div class="public-footer-bottom">
            <p>
                &copy; {{ date('Y') }} BookNest.
                All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
