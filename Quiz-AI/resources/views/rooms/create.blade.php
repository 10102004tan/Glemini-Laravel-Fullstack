@extends('layouts.app')
{{-- Body --}}
@section('content')
    <div class="w-full min-h-[100vh] bg-[var(--background)]">
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
                    @error('room_name')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </label>

                <label for="room_description" class="flex flex-col gap-[8px] w-full">
                    <span class="text-sm text-gray-300">Room description</span>
                    <input type="text" placeholder="" name="room_description" id="room_description"
                        class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
                    @error('room_description')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </label>

                <label for="quizz_id" class="min-w-[220px]">
                    <span class="text-sm text-gray-300">Select quizz</span>
                    <select name="quizz_id" id="quizz_id"
                        class="rounded-lg border bg-transparent border-gray-500 p-2 outline-none w-full text-sm">
                        @foreach ($quizzes as $quizz)
                            <option value="{{ $quizz->id }}">{{ $quizz->title }}</option>
                        @endforeach
                    </select>
                    @error('quizz_id')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </label>
            </div>

            <button type="submit"
                class="rounded-lg border text-sm bg-[var(--primary)] border-none mt-4 transition-colors duration-300 ease-in p-2 outline-none w-full">
                Create Room
            </button>

            {{-- Show all created question of user to create online room --}}
        </form>

        <h3 class="text-center text-[42px] pt-4">Created room</h3>
        <div class="grid w-[1024px] pt-8 mx-auto gap-3">
            @foreach ($rooms as $room)
                <div class="bg-[var(--background-dark)] rounded-lg p-4 flex items-center justify-between gap-4">
                    <div>
                        <h4 class="text-lg">{{ $room->room_name }}</h4>
                        <p class="text-sm text-gray-400">{{ $room->room_description }}</p>
                    </div>
                    <div>
                        <a href="{{ route('quiz.multiple.join', $room->room_id) }}"
                            class="rounded-lg border text-sm bg-[var(--primary)] border-none mt-4 transition-colors duration-300 ease-in p-2 outline-none w-full">
                            Join Room
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
@endsection
