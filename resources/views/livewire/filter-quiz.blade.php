<ul class="flex flex-col gap-4 px-4">
    <li  wire:click="filterByCategory(-1)"  class="cursor-pointer rounded p-2 {{$currentCategory == -1 ? "bg-slate-500" : ""}}">All</li>
    <li  wire:click="filterByCategory(0)"  class="cursor-pointer p-2 rounded {{$currentCategory == 0 ? "bg-slate-500" : ""}}">Nhap</li>
    <li  wire:click="filterByCategory(1)"  class="cursor-pointer p-2 rounded {{$currentCategory == 1 ? "bg-slate-500" : ""}}">Dang duyet</li>
    <li  wire:click="filterByCategory(2)"  class="cursor-pointer p-2 rounded {{$currentCategory == 2 ? "bg-slate-500" : ""}}">Cong khai</li>
    <li  wire:click="filterByCategory(3)"  class="cursor-pointer p-2 rounded {{$currentCategory == 3 ? "bg-slate-500" : ""}}">Bi tu choi</li>
</ul>