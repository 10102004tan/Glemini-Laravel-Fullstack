@extends('layouts.link_script')

{{-- Body --}}
@section('content')
    <div class="w-full h-[100vh] flex flex-col gap-3 items-center justify-center bg-[var(--primary)]">
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
        <div class="confirm px-8 py-6 bg-white rounded-lg text-center min-w-[400px]">
            <div class="my-4">
                <img src="{{ asset('icon_imgs/w=400,format=webp.avif') }}" class="w-40 mx-auto" alt="">
            </div>
            <h3 class="text-lg font-bold mb-3 text-[var(--background)]">Confirm your account</h3>
            <p class="text-sm text-[var(--background)]">Please tap the link in the email we sent to:</p>
            <h3 class="text-sm font-bold mb-4 text-gray-600">datga2442004@gmail.com</h3>

            <div class="mt-8 flex items-center justify-between">
                <div class="flex flex-col items-start gap-1">
                    <p class="text-[12px] text-gray-500">Didn't receive the email ?</p>
                    <form action="{{ route('handle_reverify', $id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-gray-600 hover:bg-gray-100 transition-colors duration-100 ease-linear text-sm font-semibold p-2 rounded-lg border border-gray-400">
                            Resend Verification Email
                        </button>
                    </form>
                </div>
                <div>
                    <form action="{{ route('handle_logout') }}" method="POST">
                        @csrf
                        <button
                            class="text-gray-500 underline text-sm hover:text-gray-600 transition-colors duration-100 ease-linear">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Your custom JavaScript here
        console.log('Page loaded');
    </script>
@endsection
