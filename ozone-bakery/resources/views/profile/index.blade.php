@extends('layouts.main')

@section('content')
    <section class="w-100 px-4 py-5">
        <div class="row d-flex justify-content-center ">
            <div class="col col-lg-7 mb-4 mb-lg-0 ">
                <div class="card mt-20">
                    <div class="col-md-8 ">
                        <div class="card-body p-4 ">
                            <div class="flex justify-content-between">
                                <div class="flex flex-col items-stretch w-6/12 max-md:w-full">
                                    <div id="scrollTarget" class="text-2xl font-bold mb-2">
                                        Profile
                                    </div>
                                </div>
                                <div class="flex flex-col w-6/12 ml-5 max-md:w-full ">
                                    <a href="#" id ="editPopupButton"
                                        class=" bg-stone-500 text-white no-underline text-base px-5 mb-2 py-1 rounded-3xl hover:bg-stone-600 ml-auto">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <div id="editPopupModal"
                                class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white rounded-lg p-8">
                                    <form method="POST" action="{{ route('profile.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Firstname -->
                                        <div>
                                            <label
                                                class="block font-medium text-sm text-gray-700 dark:text-black-300 left-align-label"
                                                for="name" :value="__('name')">
                                                Firstname
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 rounded-md shadow-sm block mt-1 w-full text-black"
                                                id="name" type="text" name="name" :value="old('name')"
                                                value="{{ $user->name }}" autofocus autocomplete="tname" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <!-- Lastname -->
                                        <div class="mt-4">
                                            <label
                                                class="block font-medium text-sm text-gray-700 dark:text-black-300 left-align-label"
                                                for="last_name" :value="__('lastname')">
                                                Lastname
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 rounded-md shadow-sm block mt-1 w-full text-black"
                                                id="lastname" type="text" name="lastname" :value="old('lastname')"
                                                value="{{ $user->lastname }}" required autofocus autocomplete="lastname" />
                                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                        </div>

                                        <!-- tel -->
                                        <div class="mt-4">
                                            <label
                                                class="block font-medium text-sm text-gray-700 dark:text-black-300 left-align-label"
                                                for="tel" :value="__('tel')">
                                                Tel
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 rounded-md shadow-sm block mt-1 w-full text-black"
                                                id="tel" type="text" name="tel" :value="old('tel')"
                                                value="{{ $user->tel }}" required autofocus autocomplete="tel" />
                                            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <label
                                                class="block font-medium text-sm text-gray-700 dark:text-black-300 left-align-label"
                                                for="email" :value="__('email')">
                                                Email
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 rounded-md shadow-sm block mt-1 w-full text-black"
                                                id="email" type="email" name="email" :value="old('email')"
                                                value="{{ $user->email }}" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="flex items-center justify-between mt-6">
                                            <button id="closeEditPopupButton" class="btn bg-stone-500 text-white no-underline text-base px-5 mb-2 py-1 rounded-3xl hover:bg-stone-600 ">Close</button>
                                            <button class="btn bg-stone-500 text-white no-underline text-base px-5 mb-2 py-1 rounded-3xl hover:bg-stone-600 ml-auto">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="mt-0 mb-2 ">
                            <div class="row pt-1 ">
                                <div class="col-6 mb-3 ">
                                    <h6 class="font-bold">
                                        Firstname
                                    </h6>
                                    <p class="text-muted ">
                                        {{ $user->name }}
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <h6 class="font-bold">
                                        Lastname
                                    </h6>
                                    <p class="text-muted ">
                                        {{ $user->lastname }}
                                    </p>
                                </div>
                            </div>
                            <h6 class="text-xl font-bold mb-2">
                                Personal
                            </h6>
                            <hr class="mt-0 mb-2 ">
                            <div class="row pt-1 ">
                                <div class="col-6 mb-3 ">
                                    <h6 class="font-bold">
                                        Phone
                                    </h6>
                                    <p class="text-muted ">
                                        {{ $user->tel }}
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <h6 class="font-bold">
                                        Email
                                    </h6>
                                    <p class="text-muted ">
                                        {{ $user->email }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
<script setup land="ts">
    document.addEventListener('DOMContentLoaded', function() {
        const editPopupButton = document.getElementById('editPopupButton');
        const editPopupModal = document.getElementById('editPopupModal');
        const closeEditPopupButton = document.getElementById('closeEditPopupButton');

        editPopupButton.addEventListener('click', function() {
            editPopupModal.classList.remove('hidden');
            // window.location.href = localhost/myprofile;
        });

        closeEditPopupButton.addEventListener('click', function() {
            editPopupModal.classList.add('hidden');
            // window.location.href = "/";
            console.log('close');
        });
    });
</script>
<style>
    #popupModal {
        z-index: 1000;
    }

    * {
        box-sizing: border-box;
    }

    .row>* {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--mdb-gutter-x)*0.5);
        padding-left: calc(var(--mdb-gutter-x)*0.5);
        margin-top: var(--mdb-gutter-y);
    }

    .row {
        --mdb-gutter-x: 1.5rem;
        --mdb-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--mdb-gutter-y)*-1);
        margin-right: calc(var(--mdb-gutter-x)*-0.5);
        margin-left: calc(var(--mdb-gutter-x)*-0.5);
    }

    .justify-content-center {
        justify-content: center !important;
    }

    @media (min-width: 200px) {
        .col-lg-7 {
            width: 35%;
        }
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    /*noinspection ALL*/
    .card {
        --mdb-card-border-radius: 0.5rem;
        --mdb-card-box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
        --mdb-card-bg: #fff;

        height: var(--mdb-card-height);
        background-color: var(--mdb-card-bg);
        border: var(--mdb-card-border-width) solid var(--mdb-card-border-color);
        border-radius: var(--mdb-card-border-radius);
        box-shadow: var(--mdb-card-box-shadow);
    }

    .col-6 {
        flex: 0 0 auto;
        width: 50%;
    }
</style>
