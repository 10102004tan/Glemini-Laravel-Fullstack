@extends('layouts.admin')
@section('content')
<div class="grid grid-cols-12 gap-[30px] mt-5">
    <div class="col-span-12">
        <h2 class="text-[30px] mb-3">1. Roles and Permissions</h2>
        <div class="flex gap-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-slate-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Permission name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <button><i class="fa-sharp fa-solid fa-plus"></i></button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr class="bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                            {{$permission->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$permission->name}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-slate-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <button><i class="fa-sharp fa-solid fa-plus"></i></button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                            {{$role->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$role->name}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="col-span-12">
        <h2 class="text-[30px] mb-3">2. Manage users role and permissions</h2>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-slate-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Roles
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Permissions
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                            {{$user->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$user->name}}
                        </td>
                        <td class="px-6 py-4">
                            @foreach($user->roles as $role)
                            <p>{{ $role->name }}</p>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            @foreach($user->permissions as $permission) <!-- Corrected here -->
                            <p>{{ $permission->name }}</p>
                            @endforeach
                        </td>
                        <td>
                            <a href="">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
@section('script')
@endsection