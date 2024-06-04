@extends('layouts.admin')
@section('content')
<div class="flex gap-3 items-center mb-3">
    <button class="px-3 py-1 rounded bg-blue-500">Cap quyen</button>
    <button class="px-3 py-1 rounded bg-blue-500">Them</button>
    <button class="px-3 py-1 rounded bg-blue-500">Loc</button>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-primary dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Full name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Total quizzes
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-primary border-b dark:bg-gray-800 dark:border-gray-700  dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    1
                </td>
                <td scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap ">
                <div>
                        <span class="sr-only">Avatar</span>
                        <span>{{$user->name}}</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                   {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    Active
                </td>
                <td class="px-6 py-4">
                    {{$user->quizz_count;}}
                </td>

                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('script')
@endsection