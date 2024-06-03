<div class="fixed w-[18vw] top-0 left-0 h-[100vh] bg-primary p-5 border-r-[1px] border-[#eeee]">
    <div class="logo flex items-center gap-4 mb-3">
        <img class="w-[25px]" src="https://codingui-evondev.vercel.app/logo.png" alt="">
        <h5 class="text-[18px]"> Quiz Gemini AI</h5>
    </div>
    <ul class="flex flex-col gap-y-2">
        <li>
            <a class="flex items-center px-4 py-3 rounded-lg gap-x-3 hover:bg-gray-800 bg-gray-800" href="#">
                <span class="w-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>
        </li>
        <li><a class="flex items-center px-4 py-3 rounded-lg gap-x-3 hover:bg-gray-800" href="{{route("quizzes.indexAdmin")}}">
                <i class="fa-brands fa-quinscape"></i>
                <span>Quiz Manage</span></a>
        </li>
        @can('super-admin')
        <li>
            <a href="{{route("users.index")}}" class="flex items-center px-4 py-3 rounded-lg gap-x-3 hover:bg-gray-800">
                <i class="fa-regular fa-users"></i>
                <span>Users</span></a>
            </a>
        </li>
        @endcan
        <li><a class="flex items-center px-4 py-3 rounded-lg gap-x-3 hover:bg-gray-800" href="/manage/filters"><span class="w-5"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                    </svg></span><span>Filters</span></a>
        </li>
    </ul>
</div>