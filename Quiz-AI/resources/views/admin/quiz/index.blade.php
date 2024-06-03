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
                    <td class="px-6 py-4">
                        {{$quiz->status}}
                    </td>

                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
@section('script')

@endsection