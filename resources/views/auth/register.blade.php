@section('title', 'Daftar Akun')

<x-guest-layout>
    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <x-alert.error :errors="$errors->all()" />
            @endif

            <x-card.card-default class="static">
                <x-form method="POST" action="{{ route('register') }}" class="md:grid md:grid-cols-2 gap-4">
                    @csrf

                    <!-- First Name -->
                    <div>
                        <x-input.input-label for="first_name" :value="__('Nama Depan')" />
                        <x-input.text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                            :value="old('first_name')" autofocus autocomplete="first_name" placeholder="John" />
                        <x-input.input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-input.input-label for="last_name" :value="__('Nama Belakang')" />
                        <x-input.text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                            :value="old('last_name')" autofocus autocomplete="last_name" placeholder="Doe" />
                        <x-input.input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input.input-label for="email" :value="__('Email')" />
                        <x-input.text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" autocomplete="username" placeholder="john@gdp.com" />
                        <x-input.input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input.input-label for="password" :value="__('Password')" />

                        <x-input.text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            autocomplete="new-password" />

                        <x-input.input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input.input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" autocomplete="new-password" />

                        <x-input.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 col-span-2">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}">
                                <x-button.link-button type="button">
                                    {{ __('Sudah Daftar?') }}
                                </x-button.link-button>
                            </a>
                        @endif

                        <x-button.primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-button.primary-button>
                    </div>
                </x-form>
            </x-card.card-default>
        </div>
    </div>
</x-guest-layout>
