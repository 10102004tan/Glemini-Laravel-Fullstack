<label class="flex flex-col items-start">
    <span class="text-white mb-2 block">{{ $title??"" }}</span>
    <select {{$type??""}} name="{{ $name??"" }}" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
        @foreach($options as $value => $label)
            <option value="{{ $value }}" >{{ $label }}</option>
        @endforeach
    </select>
</label>