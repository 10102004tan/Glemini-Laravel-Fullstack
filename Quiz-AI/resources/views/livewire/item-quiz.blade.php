<div class="rounded  overflow-hidden relative border shadow cursor-pointer hover:border-[#929090e2] bg-slate-800 w-[100%]">
    <button wire:click="showAndHidden" type="button" class="absolute p-3 right-0 z-50 top-0 text-[18px]"><i class="fa-regular fa-circle-ellipsis-vertical text-[#000]"></i></button>
    <div class="thumb h-[200px] overflow-hidden relative">
        <img class="w-full h-[100%] object-cover" src="{{asset('storage/'. $quiz['thumb'])}}" alt="Sunset in the mountains">
        <div class="flex flex-wrap py-1 gap-2 absolute {{($show ? 'bottom-0' : 'bottom-[-100%]')}} left-0">
            <form wire:submit.prevent="delete">
                <button type="submit" class="p-2 btn-delete-quiz rounded bg-red-500">Delete</button>
            </form>
            <button class="p-2 rounded bg-green-500">Edit</button>
            <button class="p-2 rounded bg-blue-500">Play</button>
        </div>
    </div>
    <div class="px-3 py-2">
        <div class="font-bold text-xl mb-2 text-white">{{$quiz['title']}}</div>
    </div>
    <div class="px-6 pt-4 pb-2 flex flex-wrap">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#question:{{count($quiz['questions'])}}</span>
        @if ($quiz['status'] == 0 )
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status: Nháp</span>
        @elseif($quiz['status'] == 1)
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status: Đang đợi duyệt</span>
        @elseif($quiz['status'] == 2)
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status: Cong khai</span>
        @else
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status:Bị từ chối</span>
        @endif
    </div>
</div>

@script 
<script>

</script>
@endscript