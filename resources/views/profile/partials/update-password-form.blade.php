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
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-3/4" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-3/4" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-3/4" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
<br>
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

<section class="bg-gray-100 p-6 rounded-lg shadow-md">
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('Update Email') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __('Ensure your account email is up-to-date.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update-email') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <x-input-label for="update_email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="update_email" name="email" type="email" class="mt-1 block w-3/4 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" autocomplete="email" :value="old('email', $admin->email ?? '')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>
<br>
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'email-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    class="text-sm text-green-600"
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
/* =========================
   STYLE GLOBAL DES SECTIONS
   ========================= */
section {
  background: #ffffff;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  padding: 2rem;
  transition: all 0.3s ease-in-out;
  margin-bottom: 2rem;
}

section:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

/* =========================
   EN-TÊTE DES SECTIONS
   ========================= */
section header h2 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #111827;
  position: relative;
  padding-bottom: 0.5rem;
  letter-spacing: -0.5px;
}

section header h2::after {
  content: "";
  position: absolute;
  width: 55px;
  height: 3px;
  bottom: 0;
  left: 0;
  border-radius: 5px;
}

section header p {
  color: #6b7280;
  font-size: 0.9rem;
  margin-top: 0.5rem;
}

/* =========================
   STYLE SPÉCIFIQUE SELON LE TYPE DE SECTION
   ========================= */

/* Section "Update Password" */
section:first-of-type header h2::after {
  background-color: #4f46e5; /* Indigo */
}
section:first-of-type:hover {
  background: linear-gradient(to bottom right, #f9fafb, #eef2ff);
}

/* Section "Update Email" */
section:nth-of-type(2) header h2::after {
  background-color: #059669; /* Emerald */
}
section:nth-of-type(2):hover {
  background: linear-gradient(to bottom right, #f0fdf4, #dcfce7);
}

/* =========================
   CHAMPS DE FORMULAIRE
   ========================= */
form input[type="password"],
form input[type="email"] {
  background-color: #ffffff;
  border: 1px solid #d1d5db;
  border-radius: 0.5rem;
  padding: 0.7rem 0.9rem;
  width: 100%;
  transition: all 0.2s ease-in-out;
  font-size: 0.95rem;
}

form input[type="password"]:focus,
form input[type="email"]:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
}

/* =========================
   LABELS
   ========================= */
x-input-label {
  display: block;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.25rem;
  font-size: 0.95rem;
}

/* =========================
   BOUTON PRINCIPAL
   ========================= */
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

/* Section email → bouton vert */
section:nth-of-type(2) x-primary-button {
  background: linear-gradient(to right, #10b981, #059669);
}
section:nth-of-type(2) x-primary-button:hover {
  background: linear-gradient(to right, #059669, #047857);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

/* =========================
   MESSAGES DE STATUT
   ========================= */
.text-green-600 {
  font-weight: 500;
  background-color: #ecfdf5;
  padding: 0.4rem 0.8rem;
  border-radius: 0.4rem;
  color: #047857;
}

.text-red-500 {
  font-size: 0.85rem;
  font-weight: 500;
  margin-top: 0.25rem;
  color: #dc2626;
}

/* Animation de fade pour le message "Saved." */
[x-data] p[x-show="show"] {
  transition: opacity 0.4s ease-in-out;
}
</style>

