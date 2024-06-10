@extends('layouts.app')
@section('content')
<div class="container bg-gradient-to-r from-[#282458] to-[#141816] px-[100px]">
    <div class="banner h-[90vh] flex items-center">
        <div class="grid h-auto grid-cols-12 gap-4">
            <div class="col-span-6 flex gap-4 flex-col">
                <h1 class="text-white text-[50px]">Study better with the help of AI</h1>
                <p>Automatically generate online quizzes, tests, and exams to level up your learning.</p>
                <span class="text-[12px]">Loved by 2000+ customers.</span>
                <div class="flex starts gap-1">
                    @for ($i = 0; $i < 5; $i++) <i class="fa-solid fa-star text-[12px] text-yellow-300"></i>
                        @endfor
                </div>

                <div class="flex gap-2">
                    <button class="px-3 py-2 rounded bg-blue-500 hover:brightness-110">Create a Quiz</button>
                    <button class="px-3 py-2 rounded bg-slate-500 hover:brightness-110">My Quiz</button>
                </div>
            </div>
            <div class="col-span-6 px-3">
                <div>
                    <div class="supports grid grid-cols-12 gap-3">
                        <div class="col-span-6">
                            <div class="item w-[100%] shadow h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://repository-images.githubusercontent.com/780829988/ebc119a3-5dac-4aee-9359-c4404cbe19aa" />
                            </div>
                        </div>
                        <div class="col-span-6 flex gap-2 flex-wrap">
                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://laravel-livewire.com/img/twitter.png" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://rohit-chouhan.gallerycdn.vsassets.io/extensions/rohit-chouhan/sweetalert2-snippet/1.1.2/1625627316335/Microsoft.VisualStudio.Services.Icons.Default" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://logowik.com/content/uploads/images/google-ai-gemini91216.logowik.com.webp" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://getlogovector.com/wp-content/uploads/2021/01/tailwind-css-logo-vector.png" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://miro.medium.com/v2/resize:fit:1400/1*9TJjrOwiMEWLEnHHNxCt9A.png" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://spatie.be/images/medialibrary/990/generic.jpg" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src="https://media.dev.to/cdn-cgi/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fi%2Fw2l9sw1ssdl4vkv3766o.jpeg" />
                            </div>

                            <div class="item w-[80px] h-auto  overflow-hidden">
                                <img class="w-[100%] rounded" src=" https://cdn.dribbble.com/userupload/4053517/file/original-3faf74424407b341ee34db992111f2d5.png?resize=1600x1200" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-[50px]">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <img class="w-[100%] rounded-[10px] shadow" src="https://cdn.mos.cms.futurecdn.net/mBKEX5WkN34SLkfmdi3kq.png" alt="">
            </div>
            <div class="px-4 py-2">
                <h2 class="text-[24px] mb-4 uppercase">Gemini AI API: A Powerful Tool for Next-Generation AI Applications</h2>
                <p>The Gemini AI API provides developers access to Google's most advanced AI models. With capabilities for understanding and generating text, images, and even code, Gemini is designed to power a new wave of innovative applications. It features a massive context window, allowing it to process and connect large amounts of information, making it ideal for complex tasks and creative projects.</p>
            </div>
        </div>
    </section>

    <section class="py-[50px]">
        <div class="text-center">
            <h5 class="text-[30px] mb-5 uppercase">Generate Result</h5>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2">
                    <ul class="flex flex-col gap-3">
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-span-10 px-5">
                    <img class="rounded-[10px] shadow mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="py-[50px]">
        <div class="text-center">
            <h5 class="text-[30px] mb-5 uppercase">Play</h5>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2">
                    <ul class="flex flex-col gap-3">
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                        <li>
                            <div>
                            <img class="rounded-[10px] w-[100%] mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-span-10 px-5">
                    <img class="rounded-[10px] shadow mx-auto p-2 border border-[#6051ee]" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
@endsection