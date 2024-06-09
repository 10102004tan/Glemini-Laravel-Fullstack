<form wire:submit.prevent="save" class="thumb overflow-hidden mb-5 ">
    <input type="file" wire:model="image" class="hidden" id="input-file">
    <label for="input-file" class="cursor-pointer">
    @if($image == null || $image == '')
        <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="https://www.cshl.edu/wp-content/uploads/2023/01/cute_robot_reading_book.jpg" alt="" />
    @else
        <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="{{$image}}" alt="" />
    @endif
    </label>
</form> 