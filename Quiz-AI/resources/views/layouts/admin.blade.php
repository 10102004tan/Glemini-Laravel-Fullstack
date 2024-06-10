<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fontaware -->
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-d53d10572a0e0d37cb8d614a3f177a0c.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-primary">
    <x-sidebars.sidebar-admin></x-sidebars.sidebar-admin>
    <main class="w-[82vw] absolute right-0 top-0 p-5">
        <div class="flex justify-end">
            <div class="profile relative ps-7">
                <label for="avarta" class="btn-delete-question relative group">
                    <input id="avarta" class="hidden action-checkbox" type="checkbox">
                    <div>
                        <img src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=1769" alt="profile" class="rounded-full h-10 w-10 cursor-pointer">
                    </div>
                    <div class="wrapper-confirm z-[99999] w-[220px] profile-option opacity-1 invisible p-5 rounded absolute top-[100%] right-0 border-[#eee] bg-primary shadow">
                        <ul class="flex gap-3 flex-col">
                            <li class="flex gap-2 items-center">
                                <i class="fas fa-user text-[14px]"></i>
                                <span class="text-[14px]">{{auth()->user()->name}}</span>
                            </li>
                            <li>
                                <form action="{{ route('handle_logout') }}" method="POST">
                                    @csrf
                                    <button class="text-white flex gap-2 items-center">
                                        <i class="fa-light fa-arrow-up-left-from-circle text-[14px]"></i>
                                        Logout out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </label>
            </div>
        </div>
        @yield('content')
    </main>
    @yield('modal')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    @yield('script')
</body>
</html>