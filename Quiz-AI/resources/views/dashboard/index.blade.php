@extends('layouts.app')
Create a dashboard can create room, and join room
@section('content')
    <h1 class="text-gray-600">Dashboard</h1>
    <form action="{{ route('handle_logout') }}" method="POST">
        @csrf
        <button class="text-gray-500">
            Logout
        </button>
    </form>
@endsection
@section('script')
    <script>
        // Your custom JavaScript here
        console.log('Page loaded');
    </script>
@endsection
