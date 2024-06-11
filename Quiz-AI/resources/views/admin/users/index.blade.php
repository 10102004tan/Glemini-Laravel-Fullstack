@extends('layouts.admin')
@section('content')

<!-- Buttons for actions -->
<div class="flex gap-3 items-center mb-3">
    <button class="px-3 py-1 rounded bg-blue-500">Cấp quyền</button>
    <button class="px-3 py-1 rounded bg-blue-500" id="addUserButton">Thêm mới</button>
    <button class="px-3 py-1 rounded bg-blue-500">Lọc</button>
</div>

<!-- Users table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-primary dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Họ và tên</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Tình trạng</th>
                <th scope="col" class="px-6 py-3">Tổng câu đố</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-primary border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 text-center" data-id={{ $user->id }}>
                <td class="px-6 py-4">{{$user->id}}</td>
                <td scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                    <div class="flex flex-wrap items-center gap-5">
                        <img class="w-7 h-7 rounded-full" src="https://quizgecko.com/images/avatars/avatar-{{ $user->id }}.webp" alt="Ảnh đại diện của {{ $user->name }}">
                        <span class="name">{{$user->name}}</span>
                    </div>
                </td>
                <td class="px-6 py-4">{{$user->email}}</td>
                <td class="px-6 py-4">Hoạt động</td>
                <td class="px-6 py-4">{{$user->quizzes->count()}}</td>
                <td class="px-6 py-4">
                    <div href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline editUserButton" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}">Chỉnh sửa</div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-medium mb-4 text-gray-900">Add User</h2>
        <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                < <label for="name" class="block text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg text-gray-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg text-gray-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg text-gray-500" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2" id="closeAddModal">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-medium mb-4 text-gray-900">Edit User</h2>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editUserId" name="id">
            <div class="mb-4">
                <label for="editName" class="block text-gray-700">Full Name</label>
                <input type="text" id="editName" name="name" class="w-full px-3 py-2 border rounded-lg text-gray-500" required>
            </div>
            <div class="mb-4">
                <label for="editEmail" class="block text-gray-700">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full px-3 py-2 border rounded-lg text-gray-500" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2" id="closeEditModal">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
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
</div>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addUserButton = document.getElementById('addUserButton');
        const addUserModal = document.getElementById('addUserModal');
        const closeAddModal = document.getElementById('closeAddModal');

        const editUserButtons = document.querySelectorAll('.editUserButton');
        const editUserModal = document.getElementById('editUserModal');
        const closeEditModal = document.getElementById('closeEditModal');
        const editUserId = document.getElementById('editUserId');
        const editName = document.getElementById('editName');
        const editEmail = document.getElementById('editEmail');

        addUserButton.addEventListener('click', () => {
            addUserModal.classList.remove('hidden');
        });

        closeAddModal.addEventListener('click', () => {
            addUserModal.classList.add('hidden');
        });

        editUserButtons.forEach(button => {
            button.addEventListener('click', () => {
                editUserId.value = button.dataset.id;
                editName.value = button.dataset.name;
                editEmail.value = button.dataset.email;

                const actionUrl = `{{ url('users') }}/${button.dataset.id}`;
                document.getElementById('editUserForm').action = actionUrl;

                editUserModal.classList.remove('hidden');
            });
        });

        closeEditModal.addEventListener('click', () => {
            editUserModal.classList.add('hidden');
        });

        // AJAX submission for Add User Form
        document.getElementById('addUserForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const userTable = document.querySelector('tbody');
                        const newRow = `
                    <tr class="bg-primary border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 text-center" data-id="${data.user.id}">
                        <td class="px-6 py-4">${data.user.id}</td>
                        <td scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            <div class="flex flex-wrap items-center gap-5">
                                <img class="w-7 h-7 rounded-full" src="https://quizgecko.com/images/avatars/avatar-${data.user.id}.webp" alt="Ảnh đại diện của ${data.user.name}">
                                <span>${data.user.name}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">${data.user.email}</td>
                        <td class="px-6 py-4">Hoạt động</td>
                        <td class="px-6 py-4">${data.user.quizzes_count}</td>
                        <td class="px-6 py-4">
                            <div href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline editUserButton" data-id="${data.user.id}" data-name="${data.user.name}" data-email="${data.user.email}">Chỉnh sửa</div>
                        </td>
                    </tr>
                `;
                        userTable.insertAdjacentHTML('beforeend', newRow);

                        addUserModal.classList.add('hidden');
                    } else {
                        alert('Failed to add user.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // AJAX submission for Edit User Form
        document.getElementById('editUserForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const userId = editUserId.value;
            const actionUrl = `{{ url('users') }}/${userId}`;
            console.log(actionUrl);
            fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const userRow = document.querySelector(`tr[data-id="${data.user.id}"]`);
                        userRow.querySelector('td:nth-child(2)').innerHTML = `
                        <div class="flex flex-wrap items-center gap-5">
                            <img class="w-7 h-7 rounded-full" src="https://quizgecko.com/images/avatars/avatar-${data.user.id}.webp" alt="Ảnh đại diện của {{ $user->name }}">
                            <span class="name">${data.user.name}</span>
                        </div>
                        `;
                        userRow.querySelector('td:nth-child(3)').innerText = data.user.email;

                        editUserModal.classList.add('hidden');
                    } else {
                        alert('Failed to edit user.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection