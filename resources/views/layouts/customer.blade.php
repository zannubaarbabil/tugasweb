<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'BookNest Customer')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body>

    <div class="customer-layout">

        {{-- =========================
            CUSTOMER NAVBAR
        ========================= --}}

        <header class="customer-navbar">

            {{-- BRAND --}}
            <a
                href="{{ route('home') }}"
                class="public-brand"
            >
                <span class="brand-icon">📚</span>

                <span>BookNest</span>
            </a>


            {{-- MENU --}}
            <nav class="customer-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">
                    Keranjang
                </a>

                <a href="{{ route('customer.orders') }}" class="{{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                    Pesanan Saya
                </a>
            </nav>


            {{-- PROFILE --}}
            <div class="customer-profile">

                <span class="customer-name">
                    {{ auth()->user()->name }}
                </span>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button type="submit">
                        Logout
                    </button>

                </form>

            </div>

        </header>


        {{-- =========================
            CUSTOMER CONTENT
        ========================= --}}

        <main class="customer-main">

            @yield('content')

        </main>


        {{-- =========================
            CUSTOMER FOOTER
        ========================= --}}

        <footer class="customer-footer">

            <div class="customer-footer-container">


                <div class="customer-footer-brand">

                    <h2>BookNest</h2>

                    <p>
                        Temukan buku dan cerita yang
                        menemani perjalananmu.
                    </p>

                </div>


                <div class="customer-footer-links">

                    <div>

                        <h3>Menu</h3>

                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>

                        <a href="{{ route('cart.index') }}">
                            Keranjang
                        </a>

                        <a href="{{ route('customer.orders') }}">
                            Pesanan Saya
                        </a>

                    </div>


                    <div>

                        <h3>BookNest</h3>

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

                </div>

            </div>


            <div class="customer-footer-bottom">

                <p>
                    &copy; {{ date('Y') }} BookNest.
                    All rights reserved.
                </p>

            </div>

        </footer>


    </div>

</body>

</html>
