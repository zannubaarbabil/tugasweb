<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        if (Auth::user()->role === 'admin') {
            $this->redirectRoute('admin.dashboard', navigate: true);
            return;
        }

        $this->redirectRoute('dashboard', navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="booknest-auth">

    <div class="booknest-auth-header">
        <div class="booknest-logo">📚</div>

        <h1>Welcome back</h1>

        <p>
            Login to continue to BookNest
        </p>
    </div>

    <x-auth-session-status
        class="text-center"
        :status="session('status')"
    />

    <form wire:submit="login" class="booknest-auth-form">

        <flux:input
            wire:model="email"
            label="Email"
            type="email"
            name="email"
            required
            autofocus
            autocomplete="email"
            placeholder="Enter your email"
        />

        <div class="booknest-password">

            <div class="booknest-password-header">
                <span>Password</span>
            </div>

            <flux:input
                wire:model="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

        </div>

        <div class="booknest-login-options">

            <flux:checkbox
                wire:model="remember"
                label="Remember me"
            />

            @if (Route::has('password.request'))
                <x-text-link href="{{ route('password.request') }}">
                    Forgot password?
                </x-text-link>
            @endif
        </div>

        <flux:button
            variant="primary"
            type="submit"
            class="booknest-login-button"
        >
            Log in
        </flux:button>

    </form>

    <div class="booknest-auth-register">
        <span>Don't have an account?</span>

        <x-text-link href="{{ route('register') }}">
            Sign up
        </x-text-link>
    </div>

</div>
