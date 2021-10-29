<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-muted">
            {{ __('auth.forgot_password_info') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('auth.inputs.email')" />
                <x-input id="email" 
                    class="" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required autofocus />
            </div>

            <div class="d-flex justify-content-end mt-4">
                <x-button>
                    {{ __('auth.buttons.reset_password_link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
