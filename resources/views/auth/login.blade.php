<x-guest-layout>
    <x-slot name="scripts">
      <script>
          console.log("Test biblioteki JQuery");
          var tmp = $('form');
          console.log(tmp);
      </script>      
  </x-slot>  
  <x-auth-card>
      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email Address -->
          {{-- <div>
              <label for="email" class="form-label">{{ __('Email') }}</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
          </div>             --}}           
          <div>
              <x-label for="email" :value="__('auth.inputs.email')" />
              <x-input id="email"
                  class=""  
                  type="email" 
                  name="email" 
                  :value="old('email')" 
                  required autofocus />
          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-label for="password" :value="__('auth.inputs.password')" />
              <x-input id="password" 
                  class=""
                  type="password"
                  name="password"
                  required autocomplete="current-password" />
          </div>

          <!-- Remember Me -->
          <div class="mt-3 form-check">
              <input id="remember_me" 
                  class="form-check-input"
                  type="checkbox" 
                  name="remember" >
              <label for="remember_me" class="form-check-label text-sm">
                  {{ __('auth.inputs.remember_me') }}
              </label>
          </div>

          <div class="d-flex justify-content-end mt-4">
              @if (Route::has('password.request'))
                  <a class="text-muted mt-3 me-3" href="{{ route('password.request') }}">
                      {{ __('auth.other.forgot_password') }}
                  </a>
              @endif
              <x-button>
                  {{ __('auth.buttons.login') }}
              </x-button>
          </div>
      </form>
  </x-auth-card>
</x-guest-layout>
