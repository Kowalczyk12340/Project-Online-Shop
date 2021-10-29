<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('auth.inputs.name')" />
                <x-input id="name" 
                    class="" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('auth.inputs.email')" />
                <x-input id="email" 
                    class="" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('auth.inputs.password')" />
                <x-input id="password" 
                    class=""
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('auth.inputs.confirm_password')" />
                <x-input id="password_confirmation" 
                    class=""
                    type="password"
                    name="password_confirmation" 
                    required />
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a class="text-muted mt-3 me-3" href="{{ route('login') }}">
                    {{ __('auth.other.already_registered') }}
                </a>
                <x-button>
                    {{ __('auth.buttons.register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
