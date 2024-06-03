@extends('layouts.admin')
@section('content')
<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-primary dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quiz name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total questions
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                <tr class="bg-primary border-b dark:bg-gray-800 dark:border-gray-700  dark:hover:bg-gray-600">
                    <td>
                        <div class="flex items-center gap-2">
                            <img class="w-[25px] rounded-[50%]" src="https://cdn3.vectorstock.com/i/1000x1000/15/37/isolated-cute-cat-avatar-vector-21041537.jpg" alt="">
                            <span>{{$quiz->user->name}}</span>
                        </div>
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                        {{$quiz->title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$quiz->questions_count;}}
                    </td>
                    <td class="px-6 py-4 flex items-center gap-1">
                        @if($quiz->status == 1)
                        <i class="fa-solid fa-spinner"></i> <span>pending</span>
                        @elseif($quiz->status== 2)
                        <i class="fa-duotone fa-badge-check text-green-400"></i><span>published</span>
                        @elseif($quiz->status== 3)
                        <i class="fa-solid fa-message-xmark"></i><span></span>rejected</span>
                        @else
                        <i class="fa-solid fa-ufo"></i><span>draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                       <div class="flex item-center gap-2">
                       <button type="button" quizId="{{$quiz->id}}" data-modal-target="timeline-modal" data-modal-toggle="timeline-modal" class="px-2 py-1 rounded bg-blue-500 btn-detail">Detail</button>
                        <button status="{{$quiz->status}}" quizId="{{$quiz->id}}" class="px-2 btn-accept py-1 rounded bg-green-500">Accept</button>
                        @if($quiz->status == 2)
                        <button quizId="{{$quiz->id}}" class="px-2 btn-delete py-1 rounded bg-red-600">Delete</button>
                        @else
                        <button quizId="{{$quiz->id}}" class="px-2 btn-reject py-1 rounded bg-red-600">Reject</button>
                        @endif
                       </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Main modal -->
@section('modal')
<div id="timeline-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative p-4 w-full lg:mx-[300px]">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Questions
                </h3>
                <button type="button" class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="timeline-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only text-black">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 overflow-y-scroll h-[60vh]" id="modal-body">
                <button class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    My Downloads
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    window.routes = {
        quizzDetails: "{{ route('quizzes.details') }}",
        quizAccept: "{{ route('quizzes.accept') }}",
    };
</script>
@endsection