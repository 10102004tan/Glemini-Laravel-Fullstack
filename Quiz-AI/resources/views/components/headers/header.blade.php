<div class="py-5 bg-gradient-to-r from-[#282458] to-[#141816]">
    <div class="container">
        <div class="flex items-center justify-between">
            <div class="flex">
                <div class="logo w-6">
                    <a href="{{route('home')}}">
                        <img src="{{ asset('images/icon-white.png') }}" alt="">
                    </a>
                </div>
                <nav>
                    <ul class="flex gap-3 ms-3">
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('quiz')}}">Quiz</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- search -->

            <form class="flex items-center max-w-sm mx-auto" method="get" action="{{ route('quiz.search') }}">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search quiz ..." required />
                </div>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>


            <div class="flex items-center gap-2">
                <a href="{{route('quizzes.create')}}" class="flex items-center gap-2 py-2 px-3 bg-yellow-400 rounded-[8px]">
                    <i class="fa-regular fa-bolt"></i>
                    <span>Generate</span>
                </a>

                @if (!Auth::check())
                <a href="{{route('login')}}" class="flex items-center gap-2 py-2 px-3 bg-blue-600 rounded-[8px]">
                    <i class="fa-regular fa-bolt"></i>
                    <span>Login</span>
                </a>
                <a href="{{route('register')}}" class="flex items-center gap-2 py-2 px-3 bg-gray-600 rounded-[8px]">
                    <i class="fa-regular fa-bolt"></i>
                    <span>Register</span>
                </a>
                @else
                <div class="profile relative ps-7 ms-3">
                    <label for="avarta" class="btn-delete-question relative group">
                        <input id="avarta" class="hidden action-checkbox" type="checkbox">
                        <div>
                            <img src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=1769" alt="profile" class="rounded-full h-10 w-10 cursor-pointer">
                        </div>
                        <div class="wrapper-confirm z-[99999] w-[220px] profile-option opacity-1 invisible p-5 rounded absolute top-[100%] right-0 border-[#eee] bg-primary shadow">
                            <ul class="flex gap-3 flex-col">
                                <li class="flex gap-2 items-center">
                                    <i class="fas fa-user text-[14px]"></i>
                                    <a href="{{ route('user_dashboard') }}" class="text-[14px]">{{auth()->user()->name}}</a>
                                </li>
                                <li class="flex gap-2 items-center">
                                    <i class="fa-regular fa-user-pen text-[14px]"></i>
                                    <a href="{{asset(route('profile.quizzes'))}}" class="text-[14px]">My Profile</a>
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
                @endif
            </div>

        </div>
    </div>
</div>