<div id="quiz-item-{{$quiz['id']}}" class="rounded overflow-hidden relative border shadow cursor-pointer bg-gray-900 border-[#59319e] hover:border-[#929090e2] w-[100%]">
    <button wire:click="showAndHidden" type="button" class="absolute p-3 right-0 z-50 top-0 text-[18px]"><i class="fa-regular fa-circle-ellipsis-vertical text-[#000]"></i></button>
    <div class="thumb h-[200px] overflow-hidden relative">
        @if($quiz['thumb'] == "")
        <img class="w-full h-[100%] object-cover" src="{{asset('images/Screenshot 2024-06-10 222619.png')}}" alt="Sunset in the mountains">
        @else
        <img class="w-full h-[100%] object-cover" src="{{asset('storage/'. $quiz['thumb'])}}" alt="Sunset in the mountains">
        @endif
        <div class="flex flex-wrap py-1 gap-2 absolute {{($show ? 'bottom-0' : 'bottom-[-100%]')}} left-0">
            <button wire:click="confirmDelete" type="button" class="p-2 btn-delete-quiz rounded bg-red-500">Delete</button>
            <a href="{{route('quizzes.edit',['id'=>$quiz['id']])}}" class="p-2 rounded bg-green-500">Edit</a>
            <a href="{{route('quiz.play',['id'=>$quiz['id']])}}" class="p-2 rounded bg-blue-500">Play</a>
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
    $wire.on('confirm', () => {
        console.log("test");
        Swal.fire({
            title: 'Thông báo',
            text: "Xac nhan xoa",
            icon: "success",
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.delete();

            }
        });
    });


    $wire.on('deleted', ({id}) => {
        Swal.fire({
            title: 'Thông báo',
            text: "Xoa thanh cong",
            icon: "success",
            confirmButtonText: 'OK'
        });
        document.getElementById('quiz-item-'+id).remove();
    });
</script>
@endscript