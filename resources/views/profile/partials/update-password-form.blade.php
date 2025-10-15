<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
    /* Section principale */
section {
  background: linear-gradient(to bottom right, #f9fafb, #eef2ff);
  border-radius: 1rem;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
  padding: 2rem;
  transition: all 0.3s ease-in-out;
}

section:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* En-tête */
section header h2 {
  font-size: 1.5rem;
  color: #1f2937;
  position: relative;
  padding-bottom: 0.5rem;
}

section header h2::after {
  content: "";
  position: absolute;
  width: 50px;
  height: 3px;
  bottom: 0;
  left: 0;
  background-color: #4f46e5;
  border-radius: 5px;
}

section header p {
  color: #6b7280;
  font-size: 0.9rem;
  margin-top: 0.5rem;
}

/* Champs de formulaire */
form input[type="password"] {
  background-color: #ffffff;
  border: 1px solid #d1d5db;
  border-radius: 0.5rem;
  padding: 0.6rem 0.8rem;
  width: 100%;
  transition: all 0.2s ease-in-out;
}

form input[type="password"]:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
}

/* Labels */
x-input-label {
  display: block;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.25rem;
}

/* Bouton principal */
x-primary-button {
  background: linear-gradient(to right, #4f46e5, #4338ca);
  color: white;
  font-weight: 600;
  padding: 0.6rem 1.5rem;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  border: none;
}

x-primary-button:hover {
  background: linear-gradient(to right, #4338ca, #3730a3);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

/* Message de succès */
.text-green-600 {
  font-weight: 500;
  background-color: #ecfdf5;
  padding: 0.4rem 0.8rem;
  border-radius: 0.4rem;
}

/* Messages d’erreur */
.text-red-500 {
  font-size: 0.85rem;
  font-weight: 500;
  margin-top: 0.25rem;
}

</style>
