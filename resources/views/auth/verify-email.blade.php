<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-muted">
            {{ __('auth.verify_email_info') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-success">
                {{ __('auth.verify_link_info') }}
            </div>
        @endif

        <div class="mt-4 d-flex justify-content-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <x-button>
                        {{ __('auth.buttons.resend_verification_email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">
                    {{ __('auth.buttons.logout') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
