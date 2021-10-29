<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-muted">
            {{ __('auth.confirm_password_info') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('auth.inputs.password')" />
                <x-input id="password" 
                    class=""
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
            </div>

            <div class="d-flex justify-content-end mt-4">
                <x-button>
                    {{ __('auth.buttons.confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
