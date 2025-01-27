<div class="thumb overflow-hidden mb-5 cursor-pointer">
    <div wire:click="showModal">
        @if($quiz->thumb == null || $quiz->thumb == '')
        <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="https://www.cshl.edu/wp-content/uploads/2023/01/cute_robot_reading_book.jpg" alt="" />
        @else
        <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="{{asset('storage/' . $quiz->thumb)}}" alt="" />
        @endif
    </div>

    <div class="fixed flex items-center justify-center inset-0  transition-all {{$isShow ? 'opacity-1 z-[99999] visible' : 'opacity-0 z-0 invisible'}}">
        <div class=" bg-[rgba(0,0,0,0.81)] absolute inset-0 z-10" wire:click="hiddenModal">
        </div>
        <div class="w-[50vw] z-20">
            <form wire:submit="save">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-primary dark:hover:bg-bray-800 dark:bg-gray-700  dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" wire:model="banner"/>
                </label>
                <button class="py-2 rounded bg-blue-600 w-[100%] text-white mt-2">Save</button>
            </form>
        </div>

    </div>
</div>