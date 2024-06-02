<button type="{{$type??"submit"}}" class="bg-primary text-[#eee] p-2 rounded-[5px] border-[1px] border-gray-400 {{ $class ?? '' }}">
    {{ $slot }}
</button>