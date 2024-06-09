@extends('layouts.app')

{{-- Body --}}
@section('content')
    <div class="w-full h-[100vh] bg-[var(--background)]">
        {{-- Create Room --}}
        <h3 class="text-center text-[42px] pt-4">Create a new room</h3>
        <form action="{{ route('quiz.multiple.handle_create_room') }}" method="POST" class="w-[1024px] pt-8 mx-auto">
            @csrf
            {{-- Hidden user id --}}
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>

            <div class="flex items-center justify-center gap-3 w-full">
                <label for="room_name" class="flex flex-col gap-[8px] w-full">
                    <span class="text-sm text-gray-300">Room name</span>
                    <input type="text" placeholder="" name="room_name" id="room_name"
                        class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
                </label>

                <label for="room_description" class="flex flex-col gap-[8px] w-full">
                    <span class="text-sm text-gray-300">Room description</span>
                    <input type="text" placeholder="" name="room_description" id="room_description"
                        class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
                </label>

                <label for="quizz_id" class="min-w-[220px]">
                    <span class="text-sm text-gray-300">Select quizz</span>
                    <select name="quizz_id" id="quizz_id"
                        class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
                        @foreach ($quizzes as $quizz)
                            <option value="{{ $quizz->id }}">{{ $quizz->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <button
            type="submit"
                class="rounded-lg border text-sm bg-[var(--primary)] border-none mt-4 transition-colors duration-300 ease-in p-2 outline-none w-full">
                Create Room
            </button>

            {{-- Show all created question of user to create online room --}}
        </form>
    </div>
@endsection
@section('script')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
@endsection
