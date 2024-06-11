@extends('layouts.app')
@section('content')
    <div class="w-full h-[100vh] flex flex-col gap-3 items-center justify-center bg-gradient-to-r from-[#282458] to-[#141816]">
        {{-- Error notify --}}
        @if ($errors->any())
            <div class="mb-2 form_error_notify bg-white rounded-lg overflow-hidden">
                <span class="block w-full p-4 bg-red-500 text-white">Error</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 p-2">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Success notify --}}
        @if (session('success'))
            <div class="form_success_notify">
                <div class="mb-2 form_error_notify bg-white rounded-lg overflow-hidden">
                    <span class="block w-full p-4 bg-green-500 text-white">Success</span>
                    <ul>
                        <li class="text-green-500 p-4">{{ session('success') }}</li>
                    </ul>
                </div>
            </div>
        @endif
        <form method="POST" action="{{ route('update_profile') }}"
            class=" h-auto flex rounded-lg bg-[var(--form-bg)] text-[var(--text)]  px-8 py-6 flex-col gap-4 sm:min-w-[400px] lg:min-w-[600px]">
            @csrf
            <h3 class="text-lg font-semibold">Profile Information</h3>
            <p class="text-sm text-gray-400">Update your account's profile information and email address.</p>

            <label for="name" class="flex flex-col gap-[8px]">
                <span class="text-sm text-gray-300">Name</span>
                <input type="text" placeholder="" name="name" id="name" value="{{ auth()->user()->name }}"
                    class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
            </label>

            <label for="email" class="flex flex-col gap-[8px]">
                <span class="text-sm text-gray-300">Email</span>
                <input type="email" placeholder="" name="email" id="email" value="{{ auth()->user()->email }}"
                    class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
            </label>

            <label for="password" class="flex flex-col gap-[8px]">
                <span class="text-sm text-gray-300">Password</span>
                <input type="password" placeholder="" name="password" id="password"
                    class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
            </label>

            <label for="confirm_password" class="flex flex-col gap-[8px]">
                <span class="text-sm text-gray-300">Confirm password</span>
                <input type="password" placeholder="" name="password_confirmation" id="confirm_password"
                    class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
            </label>

            <button
                class="rounded-lg border text-sm  border-[var(--background)] bg-[var(--background)] hover:bg-[var(--primary)] transition-colors duration-300 ease-in p-2 outline-none w-full">
                Update
            </button>
        </form>
    </div>
@endsection
@section('script')
@endsection
