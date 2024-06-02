<label for="">
    <span class="text-white block mb-2 ">{{$title??""}}</span>
    <textarea rows="{{$row??3}}" class="{{$class??""}} p-3 w-[100%] outline-none border-[2px] border-gray-400 focus:border-blue-500 rounded-[10px] bg-primary" name="{{$name}}" id="" placeholder="{{$placeholder??""}}">{{$slot??""}}</textarea>
</label>