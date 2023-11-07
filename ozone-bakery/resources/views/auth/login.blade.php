@extends('layouts.main')

@section('content')
<x-guest-layout>  
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <h1 class="text-center text-3xl font-semibold mt-3 mb-3">
                Log In
            </h1>
            <hr class="mt-7 mb-5" style="border-color: #c4b7a6; border-width: 2px; width: 100%;">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
</x-guest-layout>
@endsection
